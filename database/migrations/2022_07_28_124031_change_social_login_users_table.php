<?php

use App\Enums\AuthType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    //enum型を使って認証タイプを管理するがenum型はDBALが対応してないので、エラー回避策としてstringにマッピングする

    public function __construct(){
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum','string');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->enum('auth_type',AuthType::getValues())->after('password')->comment('認証タイプ【' . implode(', ', AuthType::getValues()). '】 ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->dropColumn('auth_type');
        });
    }
};
