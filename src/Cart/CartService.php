<?php

namespace App\Cart;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    private $session;
    private $productRepository;


    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
    }


    // Get our Cart or initialize it (empty array by default)
    public function getCart(): array
    {
        return $this->session->get('cart', []);
    }


    // Update our Cart
    public function saveCart(array $cart)
    {
        return $this->session->set('cart', $cart);
    }


    // Add a Product in our Cart
    public function addToCart(int $id)
    {
        $cart = $this->getCart();

        if(!array_key_exists($id, $cart)){
            $cart[$id] = 0;
        }

        $cart[$id]++;

        $this->saveCart($cart);
    }

    // Delete cart (remove all products)
    public function delete()
    {
        return $this->saveCart([]);
    }


    // Get All Products and their Quantity and Price to display infos in template
    public function getDetailsOfCart(): array
    {
        $detailedCart = [];

        $cart = $this->getCart();

        foreach($cart as $id => $quantity){
            $product = $this->productRepository->find($id);

            if(!$product){
                continue;
            }

            $detailedCart[] = [
                'product' => $product,
                'quantity' => $quantity,
                'totalPrice' => $quantity * $product->getPrice()
            ];
        }

        return $detailedCart;
    }


    // Get the total price of our cart (to display it on template)
    public function getTotalPrice(array $detailedCart): int
    {
        $totalPrice = 0;

        foreach($detailedCart as $value){

            $totalPrice += $value['totalPrice'];

        }

        return $totalPrice;
    }


    // Remove a Product from our Cart (if the product quantity is superior to 1, quantity goes to 0)
    public function remove(int $id)
    {
        $cart = $this->getCart();

        unset($cart[$id]);

        $this->saveCart($cart);
    }


    // Decrement the Product qauntity by 1 (or remove from cart if product quantity is 1)
    public function decrement(int $id)
    {
        $cart = $this->getCart();

        if(array_key_exists($id, $cart)){

            if($cart[$id] > 1){
                $cart[$id]--;
                $this->saveCart($cart);     
            }else{
                $this->remove($id);
            }
                  
        }    
    }

}