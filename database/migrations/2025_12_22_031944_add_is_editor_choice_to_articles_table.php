<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->boolean('is_editor_choice')
                  ->default(false)
                  ->after('status');
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('is_editor_choice');
        });
    }
};
