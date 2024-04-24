<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Baiviet\Statuspost;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Baiviet', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('image')->nullable();
            $table->tinyInteger('status')->default(Statuspost::Nhap->value);
            $table->timestamps();
        });

        Schema::create('danhmuc',function (Blueprint $table) {
            $table->id();
            $table->integer('_lft');
            $table->integer('_rgt');
            $table->foreignId('admin_id')->nullable();
            $table->foreignId('parent_id')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('feature_image')->nullable();
            $table->integer('position')->default(0);
            $table->tinyInteger('status')->default(Statuspost::XuatBan->value);
            $table->tinyInteger('is_featured')->default(0);
            $table->text('description')->nullable();
            $table->text('title_seo')->nullable();
            $table->text('desc_seo')->nullable();
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('SET NULL');
            $table->foreign('parent_id')->references('id')->on('danhmuc')->onDelete('SET NULL');

        });
        Schema::create('baiviet_danhmuc', function (Blueprint $table) {
            $table->foreignId('post_id');
            $table->foreignId('category_id');
            $table->primary(['post_id', 'category_id']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baiviet');
        Schema::dropIfExists('baiviet_danhmuc');
        Schema::dropIfExists('danhmuc');
    }
};
