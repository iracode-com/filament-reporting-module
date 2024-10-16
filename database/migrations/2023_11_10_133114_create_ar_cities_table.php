<?php

use App\Models\Location\Province;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ar_cities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Province::class)->constrained('ar_provinces')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('status')->default(true);

            // $table->id();
            // $table->foreignIdFor(Province::class)->nullable()->constrained('ar_provinces')->cascadeOnUpdate()->cascadeOnDelete();
            // $table->unsignedBigInteger('parent_branch_id')->nullable()->comment('شعبه والد');
            // $table->tinyInteger('branch_type')->comment('نوع شعبه (0:شهرستان, 1: ستاد, 2: شعبه, 3: دفترنمایندگی مستقل, 4: دفترنمایندگی وابسته, 5: مناطق شهری)');
            // $table->string('title')->comment('نام شعبه');
            // $table->string('two_digit_code_old')->nullable()->comment('کد دو رقمی شعبه');
            // $table->string('two_digit_code')->nullable()->comment('کد دو رقمی شعبه');
            // $table->string('date_establishment')->nullable()->comment('تاریخ تاسیس');
            // $table->string('phone')->nullable()->comment('شماره تماس');
            // $table->string('fax')->nullable()->comment('شماره فکس شعبه');
            // $table->string('vhf_address')->nullable()->comment('کد خطاب VHF');
            // $table->string('hf_address')->nullable()->comment('کد خطاب HF');
            // $table->string('vhf_channel')->nullable()->comment('کانال VHF');
            // $table->double('lon')->comment('طول جغرافیایی(E)');
            // $table->double('lat')->comment('عرض جغرافیایی(N)');
            // $table->string('length')->nullable()->comment('طول جغرافیایی(E)');
            // $table->string('width')->nullable()->comment('عرض جغرافیایی(N)');
            // $table->string('height')->comment('ارتفاع');
            // $table->string('img_header')->nullable()->comment('تصویر سردرب شعبه');
            // $table->string('img_building')->nullable()->comment('تصویر ساختمان شعبه');
            // $table->string('bfile1')->nullable();
            // $table->string('bfile2')->nullable();
            // $table->string('address')->nullable()->comment('آدرس پستی(نشانی)');
            // $table->tinyText('description')->nullable()->comment('توضیحات');
            // $table->string('postal_code')->nullable()->comment('کد پستی');
            // $table->tinyInteger('status')->nullable()->comment('وضعیت');
            // $table->boolean('status_emis')->default(false)->comment('وضعیت سامانه emis');
            // $table->boolean('status_equipment')->default(false)->comment('وضعیت سامانه تجهیزات');
            // $table->boolean('status_dims')->default(false)->comment('وضعیت dmis');
            // $table->boolean('status_air_relief')->default(false)->comment('وضعیت امداد هوایی');
            // $table->boolean('status_memberrcs')->default(false)->comment('وضعیت سامانه ساجد');
            // $table->boolean('status_emdadyar')->default(false)->comment('وضعیت سامانه امدادگران');
            // $table->boolean('state')->default(false)->comment('وضعیت در ممبر و امدادیار');
            // $table->boolean('status_webgis')->default(false)->comment('وضعیت webgis');
            // $table->string('coding_old')->nullable()->comment('کدینگ');
            // $table->string('coding')->nullable()->comment('کدینگ');
            // $table->integer('raromis_id')->nullable();
            // $table->integer('member_id')->nullable();
            // $table->boolean('closed_thursday')->default(false)->comment('پنجشنبه تعطیل است؟(1:آری،0:خیر)');
            // $table->string('date_closed_thursday')->nullable()->comment('تاریخ اعمال شدن تعطیلی پنجشنبه ها');
            // $table->string('date_closed_thursday_end')->nullable();
            // $table->integer('emdadyar_id')->nullable();
            // $table->integer('city_id')->nullable()->comment('کدجدول city');
            // $table->tinyInteger('type')->default(0)->comment('نوع ستادی برای فرم شهرستان');
            // $table->tinyInteger('center')->nullable()->comment('نوع مرکزی برای فرم شهرستان');
            // $table->string('full_name_governor')->nullable()->comment('نام و نام خانوادگی فرماندار');
            // $table->string('phone_governor')->nullable()->comment('شماره تماس فرماندار');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_cities');
    }
};
