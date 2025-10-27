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

        //* Get filters from query string.
        $filters = $request->getQueryParams();

        $page = isset($filters['page']) ? (int)$filters['page'] : 1;
        $page_size = isset($filters['page_size']) ? (int)$filters['page_size'] : 5;

        $this->vendors_model->setPaginationOptions($page, $page_size);

        //* Fetch vendors from database.
        $vendors = $this->vendors_model->getVendors($filters);
        //* Return JSON response.
        return $this->renderJson($response, $vendors);
    }

    /**
     * Handles GET /vendors/{vendor_id}
     * Returns a single vendor by ID
     *
     * @param Request $request The HTTP request
     * @param Response $response The HTTP response
     * @param array $uri_args URI parameters including vendor_id
     * @return Response JSON response with vendor data or error
     */
    public function handleGetVendorById(
        Request $request,
        Response $response,
        array $uri_args
    ): Response {
        //* Get vendor ID from URI and cast to integer
        $vendor_id = (int) $uri_args["vendor_id"];

        //* Fetch vendor from database
        $vendor = $this->vendors_model->findVendorById($vendor_id);

        // Handle not found case
        if ($vendor === false) {
            $error = [
                "status" => "error",
                "code" => 404,
                "message" => "Vendor not found with ID: " . $vendor_id
            ];
            return $this->renderJson($response, $error, 404);
        }

        //* Return success response
        return $this->renderJson($response, $vendor);
    }
}
