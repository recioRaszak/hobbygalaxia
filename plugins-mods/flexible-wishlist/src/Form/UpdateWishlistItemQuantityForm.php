<?php
/**
 * @package WPDesk\FlexibleWishlist
 */

namespace WPDesk\FlexibleWishlist\Form;

use WPDesk\FlexibleWishlist\Exception\InvalidFormData;
use WPDesk\FlexibleWishlist\Exception\InvalidFormRequestId;
use WPDesk\FlexibleWishlist\Exception\UnauthorizedRequest;
use WPDesk\FlexibleWishlist\Repository\WishlistItemRepository;
use WPDesk\FlexibleWishlist\Repository\WishlistRepository;
use WPDesk\FlexibleWishlist\Service\UserAuthManager;

/**
 * {@inheritdoc}
 */
class UpdateWishlistItemQuantityForm implements Form {

	const ACTION_NAME         = 'wishlist_item_update_quantity';
	const PARAM_ITEM_ID       = 'item_id';
	const PARAM_ITEM_QUANTITY = 'item_quantity';

	/**
	 * @var UserAuthManager
	 */
	private $user_auth_manager;

	/**
	 * @var WishlistRepository
	 */
	private $wishlist_repository;

	/**
	 * @var WishlistItemRepository
	 */
	private $wishlist_item_repository;

	public function __construct(
		UserAuthManager $user_auth_manager,
		WishlistRepository $wishlist_repository,
		WishlistItemRepository $wishlist_item_repository
	) {
		$this->user_auth_manager        = $user_auth_manager;
		$this->wishlist_repository      = $wishlist_repository;
		$this->wishlist_item_repository = $wishlist_item_repository;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_action_name(): string {
		return self::ACTION_NAME;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @throws InvalidFormData
	 * @throws InvalidFormRequestId
	 * @throws UnauthorizedRequest
	 */
	public function process_request( array $form_data ) {
		$wishlist_item = $this->wishlist_item_repository->get_by_id( $form_data[ self::PARAM_ITEM_ID ] );
		if ( $wishlist_item === null ) {
			throw new InvalidFormRequestId();
		}

		$wishlist = $this->wishlist_repository->get_by_id( $wishlist_item->get_list_id() );
		if ( $wishlist === null ) {
			throw new InvalidFormRequestId();
		} elseif ( $wishlist->get_user_id() !== $this->user_auth_manager->get_user()->get_id() ) {
			throw new UnauthorizedRequest();
		}

		$item_quantity = $form_data[ self::PARAM_ITEM_QUANTITY ] ?? '';
		if ( $item_quantity === '' ) {
			throw new InvalidFormData();
		}

		$wishlist_item->set_quantity( $item_quantity );
		$this->wishlist_item_repository->save( $wishlist_item );
	}
}