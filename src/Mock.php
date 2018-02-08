<?php namespace Vleks\SDK;

use Vleks\SDK\Results;

class Mock
{
    /**
     * List available products
     *
     * @param   Vleks\SDK\Requests\ListProducts $request
     * @return  Vleks\SDK\Results\ListProducts
     */
    public function listProducts($request)
    {
        return Results\ListProducts::fromXML($this->invoke('listProducts'));
    }

    /**
     * Insert/Update products
     *
     * @param   Vleks\SDK\Requests\UpdateProducts   $request
     * @return  Vleks\SDK\Results\FeedStatus
     */
    public function updateProducts($request)
    {
        return Results\FeedStatus::fromXML($this->invoke('updateProducts'));
    }

    /**
     * Delete products
     *
     * @param   Vleks\SDK\Requests\DeleteProducts   $request
     * @return  Vleks\SDK\Results\FeedStatus
     */
    public function deleteProducts($request)
    {
        return Results\FeedStatus::fromXML($this->invoke('deleteProducts'));
    }

    /**
     * Get statusses of requested feeds (changes)
     *
     * @param   Vleks\SDK\Requests\FeedStatus   $request
     * @return  Vleks\SDK\Results\FeedStatus
     */
    public function getFeedStatus($request)
    {
        return Results\FeedStatus::fromXML($this->invoke('getFeedStatus'));
    }

    /**
     * Get results of requested feeds (changes)
     *
     * @param   Vleks\SDK\Requests\FeedResult   $request
     * @return  Vleks\SDK\Results\FeedResult
     */
    public function getFeedResult($request)
    {
        return Results\FeedResult::fromXML($this->invoke('getFeedResult'));
    }

    /**
     * List Orders
     *
     * @param   Vleks\SDK\Requests\ListOrders   $request
     * @return  Vleks\SDK\Results\ListOrders
     */
    public function listOrders($request)
    {
        return Results\ListOrders::fromXML($this->invoke('listOrders'));
    }

    /**
     * Reject Orders
     *
     * @param   Vleks\SDK\Requests\RejectOrders $request
     * @param   Vleks\SDK\Results\FeedStatus
     */
    public function rejectOrders($request)
    {
        return Results\FeedStatus::fromXML($this->invoke('rejectOrders'));
    }

    /**
     * Accept Orders
     *
     * @param   Vleks\SDK\Requests\AcceptOrders $request
     * @param   Vleks\SDK\Results\FeedStatus
     */
    public function acceptOrders($request)
    {
        return Results\FeedStatus::fromXML($this->invoke('acceptOrders'));
    }

    /**
     * Cancel Orders
     *
     * @param   Vleks\SDK\Requests\CancelOrders $request
     * @param   Vleks\SDK\Results\FeedStatus
     */
    public function cancelOrders($request)
    {
        return Results\FeedStatus::fromXML($this->invoke('cancelOrders'));
    }

    /**
     * Finish Orders
     *
     * @param   Vleks\SDK\Requests\FinishOrders $request
     * @param   Vleks\SDK\Results\FeedStatus
     */
    public function finishOrders($request)
    {
        return Results\FeedStatus::fromXML($this->invoke('finishOrders'));
    }

    /**
     * List Shipments
     *
     * @param   Vleks\SDK\Requests\ListShipments    $request
     * @return  Vleks\SDK\Results\ListShipments
     */
    public function listShipments($request)
    {
        return Results\ListShipments::fromXML($this->invoke('listShipments'));
    }

    /**
     * Add Shipments
     *
     * @param   Vleks\SDK\Requests\AddShipments $request
     * @return  Vleks\SDK\Results\FeedStatus
     */
    public function addShipments($request)
    {
        return Results\FeedStatus::fromXML($this->invoke('addShipments'));
    }

    /**
     * Load required response files
     *
     * @param   string  $actionName
     * @return  string
     */
    private function invoke($actionName)
    {
        return file_get_contents('Mock/' . $actionName . '.xml', true);
    }
}
