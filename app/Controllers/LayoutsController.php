<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Domain\Models\KeyboardsModel;
use App\Domain\Models\KeycapSetsModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Controller for handling layout-related resource
 * requests.
 *
 * @author Ishi <lalinglabrador@gmail.com>
 */
class LayoutsController extends BaseController
{
    public function __construct(
        private KeyboardsModel $keyboards_model,
        private KeycapSetsModel $keycap_sets_model
    ) {}

    /**
     * Handles GET /layouts/{layout_id}/keybaords.
     * Returns keyboards that use a specific layout (sub-collection).
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The HTTP Request
     * @param \Psr\Http\Message\ResponseInterface $response The HTTP Response
     * @param array $uri_args URI parameters including layout_id
     * @return Response JSON response with layout and keyboards data or error
     */
    public function  handleGetKeyboardsByLayoutId(
        Request $request,
        Response $response,
        array $uri_args
    ) : Response {
        $layout_id = (int) $uri_args["layout_id"];

        $filters = $request->getQueryParams();

        // Fetch keyboards for this layout
        $result = $this->keyboards_model->getKeyboardsByLayoutId($layout_id, $filters);

        if ($result === false) {
            $error = [
                "status" => "error",
                "code" => 404,
                "message" => "Layout not found with ID:  " . $layout_id
            ];
            return $this->renderJson($response, $error, 404);
        }

        return $this->renderJson($response, $result);
    }

    /**
     * Handles GET /layouts/{layout_id}/keycap-sets.
     * Return keycap sets compatible with a specific layout (sub-collection)
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The HTTP Request
     * @param \Psr\Http\Message\ResponseInterface $response The HTTP Request
     * @param array $uri_args URI Parameters including layout_id
     * @return Response JSON response with layout and keycap sets or data or error
     */
    public function handleGetKeycapSetsByLayoutId(
        Request $request,
        Response $response,
        array $uri_args
    ): Response {

        $layout_id = (int) $uri_args["layout_id"];

        $filters = $request->getQueryParams();

        $result = $this->keycap_sets_model->getKeycapSetsByLayoutId($layout_id, $filters);

        if ($result === false) {
            $error = [
                "status" => "error",
                "code" => 404,
                "message" => "Layout not found with ID: " . $layout_id
            ];
            return $this->renderJson($response, $error, 404);
        }

        return $this->renderJson($response, $result);
    }

}
