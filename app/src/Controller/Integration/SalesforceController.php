<?php

namespace App\Controller\Integration;

use App\Service\SaleforceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SalesforceController extends AbstractController
{
    public function __construct(private SaleforceService $saleforceService)
    {
    }

    #[Route('/api/integration/salesforce/share', name: 'app_integration_salesforce_share', methods: ['POST'])]
    public function share(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true)['data'];

//        try {
            $token = $this->saleforceService->authSalesforce();

            $accountID = $this->saleforceService->createAccount($token, $data["companyName"]);

            $this->saleforceService->createContact($token, $accountID, $data);
//        } catch (\Exception $exception) {
//            return new JsonResponse(['message' => 'Failed!', 'error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
//        }

        return new JsonResponse(['message' => 'Shared!'], Response::HTTP_OK);
    }
}
