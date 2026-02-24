<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Service\CheckoutService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    private CheckoutService $checkoutService;

    /**
     * @param CheckoutService $checkoutService
     */
    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function checkout(): Response
    {
        $result = $this->checkoutService->checkout(Session::get('username'));

        return response()
            ->view('features.checkout', [
                'title' => 'Checkout | U-Canteen',
                'carts' => $result
            ]);
    }

    public function process(CheckoutRequest $request): RedirectResponse|Response
    {
        try {
            $validate = $request->validated();

            $validate['invoice'] = time();

            $result = $this->checkoutService->process($validate);
            if ($result) {
                $url = URL::temporarySignedRoute('checkout.invoice', Carbon::now()->addMinutes(5), ['id' => $validate['invoice']]);
                return redirect($url);
            }

            return redirect('/checkout')->with('error', 'Gagal melakukan checkout');
        } catch (ValidationException $exception) {
            return redirect('/checkout')
                ->withErrors($exception->errors())
                ->withInput();
        } catch (\Exception $exception) {
            return redirect('/checkout')->with('error', 'Terjadi kesalahan: ' . $exception->getMessage());
        }
    }

    public function invoice(Request $request,string $id): Response
    {
        if ($request->hasValidSignature()) {
            return response()->view('features.invoice', [
                'title' => "invoice | U-Canteen",
                'id' => $id
            ]);
        }
        return response("URL Expired", 403);
    }

    public function invoiceDownload(string $id): Response
    {
        $data = $this->checkoutService->getInvoice($id);

        $pdf = Pdf::loadView('features.invoiceTemplate', [
            'title' => "invoice | U-Canteen",
            'invoiceData' => $data['invoice'],
            'userData' => $data['user'],
            'id' => $id

        ]);

        return $pdf->download("invoice-$id.pdf");
    }


}
