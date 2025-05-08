<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // This column is required for the token name
            $table->string('token'); // The token itself
            $table->text('abilities')->nullable(); // The abilities associated with the token (optional)
            $table->timestamp('expires_at')->nullable(); // Expiration timestamp for the token (optional)
            $table->morphs('tokenable'); // Creates tokenable_id and tokenable_type for polymorphic relation
            $table->timestamp('last_used_at')->nullable(); // This is the column to track the last used time of the token
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_access_tokens');
    }
}
