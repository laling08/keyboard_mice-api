<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Domain\Models\SwitchesModel;
use App\Domain\Models\VendorsModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

/**
 * Controller for handling switch resource request
 *
 * @author Ishi <lalinglabrador@email.com>
 */
class SwitchesController extends BaseController
{
    public function __construct(private SwitchesModel $switches_model) {}
    /**
     * Handles GET /vendors/{vendor_id}/switches.
     * Returns switches manufactured by a specific vendor (sub-collection).
     *
     * @param Request $request The HTTP Request.
     * @param Response $response The HTTP Response.
     * @param array $uri_args URI parameters including vendor_id.
     * @return Response JSON response with vendor and switches data or error.
     */
    public function handleGetSwitchesByVendorId(
        Request $request,
        Response $response,
        array $uri_args
    ): Response {
        //* Extract vendor ID from URI.
        $vendor_id = (int) $uri_args["vendor_id"];

        //* Get filter parameters from query string.
        $filters = $request->getQueryParams();

        $page = isset($filters['page']) ? (int)$filters['page'] : 1;
        $page_size = isset($filters['page_size']) ? (int)$filters['page_size'] : 5;

        $this->switches_model->setPaginationOptions($page, $page_size);

        //* Fetch switches for this vendor.
        $result = $this->switches_model->getSwitchesByVendorId($vendor_id, $filters);

        //* Handle case where vendor does not exist.
        if ($result === false) {
            $error = [
                "status" => "error",
                "code" => 404,
                "message" => "Vendor not found with IDL " . $vendor_id
            ];
            return $this->renderJson($response, $error, 404);
        }

        return $this->renderJson($response, $result);
    }
}
