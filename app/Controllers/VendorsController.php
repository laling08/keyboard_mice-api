<?php

namespace App\Controllers;

use App\Domain\Models\VendorsModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class VendorsController extends BaseController
{
    public function __construct(private VendorsModel $vendors_model) {}

    /**
     * Handles GET /vendors
     * Returns a paginated list of vendors with optional filters.
     *
     * @param Request $request The HTTP Request.
     * @param Response $response The HTTP Response.
     * @return Response JSON response with vendors data.
     */
    public function handleGetVendors(Request $request, Response $response): Response
    {
        // TODO: Get a list of zero or more vendor resources that match the request's filtering criteria

        // Get filters from query string.
        $filters = $request->getQueryParams();
        // Fetch vendors from database.
        $vendors = $this->vendors_model->getVendors($filters);
        // Return JSON response.
        return $this->renderJson($response, $vendors);
    }
}
