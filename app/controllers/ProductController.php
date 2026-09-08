<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('database');
        $this->call->library('session');
        $this->call->model('ProductModel');
    }

    /**
     * Read - Display all products.
     */
    public function index()
    {
        $data['products']  = $this->ProductModel->all();
        $data['auth_user'] = $this->session->userdata('auth_user');

        $this->call->view('products_view', $data);
    }

    /**
     * Create - Show form (GET) and store a new product (POST).
     */
    public function create()
    {
        $product = [
            'product_name' => '',
            'description'  => '',
            'price'        => '',
            'quantity'     => '',
        ];
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = [
                'product_name' => trim((string) $this->request->post('product_name', '')),
                'description'  => trim((string) $this->request->post('description', '')),
                'price'        => trim((string) $this->request->post('price', '')),
                'quantity'     => trim((string) $this->request->post('quantity', '')),
            ];

            $error = $this->validate($product);

            if ($error === null) {
                $this->ProductModel->insert([
                    'product_name' => $product['product_name'],
                    'description'  => $product['description'],
                    'price'        => (float) $product['price'],
                    'quantity'     => (int) $product['quantity'],
                ]);
                redirect('products');
                return;
            }
        }

        $this->call->view('product_form_view', [
            'product'      => $product,
            'error'        => $error,
            'form_action'  => 'products/create',
            'form_title'   => 'Add Product',
            'submit_label' => 'Add product',
        ]);
    }

    /**
     * Update - Show edit form for an existing product.
     */
    public function edit($id)
    {
        $product = $this->ProductModel->find((int) $id);
        if (!$product) {
            $this->response->set_status_code(404);
            $this->call->view('errors/error_404');
            return;
        }

        $this->call->view('product_form_view', [
            'product'      => $product,
            'error'        => null,
            'form_action'  => 'products/update/' . (int) $id,
            'form_title'   => 'Edit Product',
            'submit_label' => 'Save changes',
        ]);
    }

    /**
     * Update - Persist changes to an existing product.
     */
    public function update($id)
    {
        $product = [
            'product_name' => trim((string) $this->request->post('product_name', '')),
            'description'  => trim((string) $this->request->post('description', '')),
            'price'        => trim((string) $this->request->post('price', '')),
            'quantity'     => trim((string) $this->request->post('quantity', '')),
        ];

        $error = $this->validate($product);

        if ($error !== null) {
            $this->call->view('product_form_view', [
                'product'      => $product,
                'error'        => $error,
                'form_action'  => 'products/update/' . (int) $id,
                'form_title'   => 'Edit Product',
                'submit_label' => 'Save changes',
            ]);
            return;
        }

        $this->ProductModel->update((int) $id, [
            'product_name' => $product['product_name'],
            'description'  => $product['description'],
            'price'        => (float) $product['price'],
            'quantity'     => (int) $product['quantity'],
        ]);
        redirect('products');
    }

    /**
     * Delete - Remove a product.
     */
    public function delete($id)
    {
        $this->ProductModel->delete((int) $id);
        redirect('products');
    }

    /**
     * Simple server-side validation shared by create() and update().
     *
     * @param array $product
     * @return string|null Error message, or null when valid.
     */
    private function validate(array $product)
    {
        if ($product['product_name'] === '') {
            return 'Product name is required.';
        }

        if ($product['price'] === '' || !is_numeric($product['price']) || (float) $product['price'] < 0) {
            return 'Price must be a valid, non-negative number.';
        }

        if ($product['quantity'] === '' || !ctype_digit((string) $product['quantity'])) {
            return 'Quantity must be a valid, non-negative whole number.';
        }

        return null;
    }
}
