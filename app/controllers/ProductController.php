<?php
class ProductController extends Controller
{
    protected $modelProduct;

    public function __construct()
    {
        $this->modelProduct = $this->model('Product');
    }
    public function index()
    {
        $data = [
            'products' => $this->modelProduct->getProduct(),
        ];
        return $this->view("product/index", $data);
    }

    public function edit($id)
    {
        var_dump($this->modelProduct->getProductById($id));
    }

    public function category($category)
    {
        $data = [
            'products' => $this->modelProduct->byCategory($category),
            'category' => $category
        ];

        return $this->view('product/index', $data);
    }
}
