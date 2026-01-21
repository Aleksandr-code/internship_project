<?php

namespace App\Service;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SaleforceService
{
    public function __construct(
        private HttpClientInterface $httpClient,
        #[Autowire(env: 'SALESFORCE_CLIENT_ID')] private string $salesforceClientId,
        #[Autowire(env: 'SALESFORCE_CLIENT_SECRET')] private string $salesforceClientSecret,
        #[Autowire(env: 'SALESFORCE_LOGIN_URL')] private string $salesforceLoginUrl,
    )
    {
    }

    function authSalesforce():string
    {
        $response = $this->httpClient->request(
            'POST',
            $this->salesforceLoginUrl . '/services/oauth2/token',
            [
                'body' => [
                    'client_id' => $this->salesforceClientId,
                    'client_secret' => $this->salesforceClientSecret,
                    'grant_type' => 'client_credentials',
                ]
            ]
        );

        $data = json_decode($response->getContent(), true);

        return $data['access_token'];
    }

    function createAccount(string $token, string $nameCompany):string
    {
        $response = $this->httpClient->request(
            'POST',
            $this->salesforceLoginUrl . '/services/data/v65.0/sobjects/Account',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'Name' => $nameCompany,
                ]
            ]
        );

        $data = json_decode($response->getContent(), true);
        $accountID = $data['id'];

        return $accountID;
    }

    function createContact(string $token, string $accountID, array $data):string
    {

        $validatedData["FirstName"] = $data["firstName"] ?? '';
        $validatedData["LastName"] = $data["lastName"] ?? '';
        $validatedData["AccountId"] = $accountID;
        $validatedData["Phone"] = $data["phone"] ?? '';

        $response = $this->httpClient->request(
            'POST',
            $this->salesforceLoginUrl . '/services/data/v65.0/sobjects/Contact',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ],
                'json' => $validatedData
            ]
        );

        $data = json_decode($response->getContent(), true);
        $contactID = $data['id'];

        return $contactID;

    }
}
