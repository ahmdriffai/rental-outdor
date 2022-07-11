<?php

namespace Tests\Feature\Services;

use App\Helper\Media;
use App\Http\Requests\EquipmentAddRequest;
use App\Http\Requests\EquipmentUpdateRequest;
use App\Models\Category;
use App\Models\Equipment;
use App\Services\EquipmentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class EquipmentServiceTest extends TestCase
{
    use RefreshDatabase, Media;

    private EquipmentService $equipmentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->equipmentService = $this->app->make(EquipmentService::class);
    }

    public function test_provider_equipment()
    {
        self::assertTrue(true);
    }

    public function test_add_equipment_success()
    {
        $category = Category::factory()->create();
        $request = new EquipmentAddRequest([
            'name' => 'test add',
            'price' => 1,
            'description' => 'test desc',
            'category_id' => $category->id,
        ]);

        $this->equipmentService->add($request);

        $this->assertDatabaseCount('equipment', 1);
        $this->assertDatabaseHas('equipment', [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $category->id,
            'image_path' => null,
            'image_url' => null,
        ]);
    }

    public function test_update_equioment_success()
    {
        $category = Category::factory()->create();
        $equipment = Equipment::factory()->create();
        $request = new EquipmentUpdateRequest([
            'name' => 'test update',
            'price' => 1,
            'description' => 'test update',
            'category_id' => $category->id,
        ]);

        $result = $this->equipmentService->update($request, $equipment->id);

        $this->assertDatabaseCount('equipment', 1);
        $this->assertDatabaseHas('equipment', [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $category->id,
            'image_path' => null,
            'image_url' => null,
        ]);

        self::assertNotSame($equipment->name, $result->name);
        self::assertNotSame($equipment->price, $result->price);
        self::assertNotSame($equipment->description, $result->description);
        self::assertNotSame($equipment->category_id, $result->category_id);
    }

    public function test_delete_menu_without_file()
    {
        $equipment = Equipment::factory()->create();

        $this->assertDatabaseCount('equipment', 1);

        $this->equipmentService->delete($equipment->id);

        $this->assertDatabaseCount('equipment', 0);
    }

    public function test_delete_menu_with_file() {
        $file = UploadedFile::fake()->image('test');
        $uploads = $this->uploads($file, 'test/');
        $equipmet = Equipment::factory()->create(['image_path' => public_path('storage/'. $uploads['filePath'])]);

        self::assertFileExists($equipmet->image_path);
        $this->assertDatabaseCount('equipment', 1);

        $this->equipmentService->delete($equipmet->id);

        $this->assertDatabaseCount('equipment', 0);
        self::assertFileDoesNotExist($equipmet->image_path);
    }

    public function test_add_image()
    {
        $equipent = Equipment::factory()->create();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $result = $this->equipmentService->addImage($file, $equipent->id);

        $this->assertDatabaseHas('equipment', [
            'image_url' => $result->image_url,
            'image_path' => $result->image_path,
        ]);

        self::assertNotNull($result->image_url);

        self::assertFileExists($result->image_path);

        @unlink($result->image_path);
    }

    public function test_update_file_sukses()
    {
        $file = UploadedFile::fake()->create('file.pdf');
        $uploads = $this->uploads($file, 'test/');
        $equipment = Equipment::factory()->create([
            'image_path' => public_path('storage/' . $uploads['filePath']),
        ]);


        self::assertFileExists($equipment->image_path);
        $this->assertDatabaseCount('equipment', 1);

        $newFile = UploadedFile::fake()->create('file.doc');
        $result = $this->equipmentService->updateImage($newFile, $equipment->id);

        $this->assertDatabaseCount('equipment', 1);

        self::assertFileDoesNotExist($equipment->image_path);

        self::assertFileExists($result->image_path);

        self::assertNotSame($equipment->image_path , $result->image_path);
        self::assertNotSame($equipment->image_url , $result->image_url);

        @unlink($result->image_path);

    }
}
