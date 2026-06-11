<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_users', function (Blueprint $table) {
            // status: 'b' = banned, 'd' = deleted, '' = active
            if (!Schema::hasColumn('tbl_users', 'status')) {
                $table->char('status', 1)->default('')->after('isActive');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_users', function (Blueprint $table) {
            if (Schema::hasColumn('tbl_users', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};

