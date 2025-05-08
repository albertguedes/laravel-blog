<?php declare(strict_types=1);

namespace Tests\Unit\View\Components;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\TestCase;

class CategoryTreeComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_tree_returns_view()
    {
        DB::connection()->getFacadeAccessor()->setAsGlobal();

        DB::setDefaultConnection(':memory:');
        $parent = Category::create(['title' => 'Parent Category']);
        $child = Category::create(['title' => 'Child Category', 'parent_id' => $parent->id]);

        $view = $this->blade('<x-category-tree-component />');
        $view->assertSee('Parent Category');
        $view->assertSee('Child Category');
    }
}
