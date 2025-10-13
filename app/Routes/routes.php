<?php

declare(strict_types=1);

use App\Controllers\AboutController;
use App\Controllers\KeyboardsController;
use App\Controllers\SwitchesController;
use App\Controllers\VendorsController;
use App\Controllers\LayoutsController;
use App\Helpers\DateTimeHelper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\Route;

return static function (Slim\App $app): void { //! add your routes within this function

    // Routes without authentication check: /login, /token

    //* ROUTE: GET /
    $app->get('/', [AboutController::class, 'handleAboutWebService']);

    //* NOTE: callback naming pattern: handle<ActionName>, e.g. handleGetPlayers
    //* ROUTE: GET /players
    //$app->get('/players', [PlayersController::class, 'handleGetPlayers']);

    // ========================================
    // VENDOR RESOURCES
    // ========================================

    //* ROUTE: GET /vendors
    $app->get('/vendors', [VendorsController::class, 'handleGetVendors']);

    //* ROUTE: GET /vendors/{vendor_id}
    $app->get('/vendors/{vendor_id}', [VendorsController::class, 'handleGetVendorById']);

    //* ROUTE: GET vendors/{vendors_id}/switches
    $app->get('/vendors/{vendor_id}/switches', [SwitchesController::class, 'handleGetSwitchesByVendorId']);

    //========================================
    // KEYBOARD RESOURCES
    // ========================================
    //* ROUTE: GET /keyboards
    $app->get('/keyboards', [KeyboardsController::class, 'handleGetKeyboards']);

    //* ROUTE: GET keyboards/{keyboard_id}
    $app->get('/keyboards/{keyboard_id}', [KeyboardsController::class, 'handleGetKeyboardById']);

    //========================================
    // LAYOUT RESOURCES
    // ========================================
     //* ROUTE: GET /layouts/{layout_id}/keyboards
    // Sub-collection resource: Get keyboards that use a specific layout
    $app->get('/layouts/{layout_id}/keyboards', [LayoutsController::class, 'handleGetKeyboardsByLayoutId']);

    //* ROUTE: GET /layouts/{layout_id}/keycap-sets
    // Sub-collection resource: Get keycap sets compatible with a specific layout
    $app->get('/layouts/{layout_id}/keycap-sets', [LayoutsController::class, 'handleGetKeycapSetsByLayoutId']);

    //* ROUTE: GET /ping
    $app->get('/ping', function (Request $request, Response $response, $args) {

        $payload = [
            "greetings" => "Reporting! Hello there!",
            "now" => DateTimeHelper::now(DateTimeHelper::Y_M_D_H_M),
        ];
        $response->getBody()->write(json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR));
        return $response;
    });
    // Example route to test error handling.
    $app->get('/error', function (Request $request, Response $response, $args) {
        throw new \Slim\Exception\HttpNotFoundException($request, "Something went wrong");
    });
};
