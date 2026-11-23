<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FoundationRepairTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_route_renders_with_empty_catalog(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_product_schema_uses_canonical_fields(): void
    {
        $category = Category::create([
            'name' => 'Buket Bunga',
            'slug' => 'buket-bunga',
            'description' => null,
            'is_active' => true,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Test Bouquet',
            'slug' => 'test-bouquet',
            'price' => 100000,
            'description' => 'Test description',
            'image_path' => 'products/test.jpg',
            'is_available' => true,
        ]);

        $this->assertSame('100000.00', $product->fresh()->price);
    }

    public function test_catalog_estimate_rejects_ids_unrelated_to_product(): void
    {
        $category = Category::create([
            'name' => 'Buket Bunga',
            'slug' => 'buket-bunga',
            'description' => null,
            'is_active' => true,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Test Bouquet',
            'slug' => 'test-bouquet',
            'price' => 100000,
            'description' => 'Test description',
            'image_path' => 'products/test.jpg',
            'is_available' => true,
        ]);

        $this->postJson('/katalog/test-bouquet/estimasi', [
            'option_value_ids' => [999],
            'add_on_ids' => [999],
        ])->assertOk()->assertJson([
            'base_price' => 100000.0,
            'personalization_total' => 0.0,
            'add_on_total' => 0.0,
            'estimated_total' => 100000.0,
        ]);
    }

    public function test_admin_login_route_renders_and_logout_is_protected_by_post(): void
    {
        $this->get('/admin/login')->assertOk();
        $this->post('/admin/logout')->assertRedirect('/admin/login');
    }
}
