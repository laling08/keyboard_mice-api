<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Domain\Models\MiceModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Controller for handling mouse resource requests
 *
 * @author Ishi <lalinglabrador@gmail.com>
 */
class MiceController extends BaseController
{
    public function __construct(private MiceModel $mice_model) {}

    /**
     * Handles GET /mice
     * Returns a paginated list of mice with optional filters
     *
     * @param Request $request The HTTP request
     * @param Response $response The HTTP response
     * @return Response JSON response with mice data
     */
    public function handleGetMice(Request $request, Response $response): Response
    {
        // Get filters from query string
        $filters = $request->getQueryParams();

        // Fetch mice from database
        $mice = $this->mice_model->getMice($filters);

        // Return JSON response
        return $this->renderJson($response, $mice);
    }

    /**
     * Handles GET /mice/{mouse_id}/buttons
     * Returns buttons for a specific mouse (sub-collection)
     *
     * @param Request $request The HTTP request
     * @param Response $response The HTTP response
     * @param array $uri_args URI parameters including mouse_id
     * @return Response JSON response with mouse and buttons data or error
     */
    public function handleGetButtonsByMouseId(
        Request $request,
        Response $response,
        array $uri_args
    ): Response {
        // Get mouse ID from URI
        $mouse_id = (int) $uri_args["mouse_id"];

        // Get filters from query string
        $filters = $request->getQueryParams();

        // Fetch buttons for this mouse
        $result = $this->mice_model->getButtonsByMouseId($mouse_id, $filters);

        // Handle case where mouse doesn't exist
        if ($result === false) {
            $error = [
                "status" => "error",
                "code" => 404,
                "message" => "Mouse not found with ID: " . $mouse_id
            ];
            return $this->renderJson($response, $error, 404);
        }

        // Return structured sub-collection response
        return $this->renderJson($response, $result);
    }
}
