<?php namespace WpRestServer\Endpoints;

use WP_REST_Controller;

/**
 * ReadOnlyEndpoint
 */
class ReadOnlyEndpoint extends WP_REST_Controller
{
    /**
     * Checks if a given request has access to create items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error
     */
    final public function create_item_permissions_check($request)
    {
        return new WP_Error('rest_forbidden_context', __('Permission denied.', 'wp-rest-server'), ['status' => 405]);
    }

    /**
     * Creates one item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error
     */
    final public function create_item($request)
    {
        return new WP_Error('rest_forbidden_context', __('Permission denied.', 'wp-rest-server'), ['status' => 405]);
    }

    /**
     * Checks if a given request has access to update a specific item.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error
     */
    final public function update_item_permissions_check($request)
    {
        return new WP_Error('rest_forbidden_context', __('Permission denied.', 'wp-rest-server'), ['status' => 405]);
    }

    /**
     * Updates one item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error
     */
    final public function update_item($request)
    {
        return new WP_Error('rest_forbidden_context', __('Permission denied.', 'wp-rest-server'), ['status' => 405]);
    }

    /**
     * Checks if a given request has access to delete a specific item.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error
     */
    final public function delete_item_permissions_check($request)
    {
        return new WP_Error('rest_forbidden_context', __('Permission denied.', 'wp-rest-server'), ['status' => 405]);
    }

    /**
     * Deletes one item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error
     */
    final public function delete_item($request)
    {
        return new WP_Error('rest_forbidden_context', __('Permission denied.', 'wp-rest-server'), ['status' => 405]);
    }
}
