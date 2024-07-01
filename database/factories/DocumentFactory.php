<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Document;
use Illuminate\Support\Str;
use App\Models\CategoryDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{

    protected $model = Document::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryDocumentId = CategoryDocument::inRandomOrder()->value('id');
        $userId = User::inRandomOrder()->value('id');
        $statusOptions = ['isPublished' , 'isDraft', 'isPlanned', 'isUpdated'];
        $status = $statusOptions[array_rand($statusOptions)];
        $name = $this->faker->sentence(3);
        return [
            'name' => $name,
            'description' => $this->faker->paragraph(),
            'content' => $this->faker->text(),
            'size' => $this->faker->randomNumber(3),
            'views_count' => $this->faker->randomNumber(3),
            'slug' => Str::slug($name),
            'downloads_count' => $this->faker->randomNumber(3),
            'category_document_id' => $categoryDocumentId,
            'user_id' => $userId,
            'status' => $status,
        ];
    }
}
