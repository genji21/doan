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
        // 1. Admin
        Schema::create('tbl_admin', function (Blueprint $table) {
            $table->id(); // Assuming 'id' is standard, if not we might need to change
            $table->string('username')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->timestamps();
        });

        // 2. Users (tbl_users)
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id('userId'); // Primary key matched model usage if applicable, or map standard id
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('fullName');
            $table->string('phoneNumber')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('activation_token')->nullable();
            $table->string('google_id')->nullable();
            $table->char('isActive', 1)->default('n'); // 'y' or 'n'
            $table->timestamps();
        });

        // 3. Tours (tbl_tours)
        Schema::create('tbl_tours', function (Blueprint $table) {
            $table->id('tourId');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('priceAdult', 10, 2);
            $table->decimal('priceChild', 10, 2);
            $table->string('time'); // e.g., "3 days 2 nights"
            $table->string('destination');
            $table->integer('quantity');
            $table->boolean('availability')->default(0); // or TinyInteger
            $table->string('domain')->nullable(); // 'b', 't', 'n'
            $table->date('startDate');
            $table->date('endDate');
            $table->timestamps();
        });

        // 4. Images (tbl_images)
        Schema::create('tbl_images', function (Blueprint $table) {
            $table->id('imageId');
            $table->unsignedBigInteger('tourId');
            $table->string('imageUrl');
            $table->string('description')->nullable();
            // Foreign key
            $table->foreign('tourId')->references('tourId')->on('tbl_tours')->onDelete('cascade');
        });

        // 5. Temporary Images (tbl_temp_images)
        Schema::create('tbl_temp_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tourId');
            $table->string('imageTempURL');
            $table->timestamps();
            $table->foreign('tourId')->references('tourId')->on('tbl_tours')->onDelete('cascade');
        });

        // 6. Timeline (tbl_timeline)
        Schema::create('tbl_timeline', function (Blueprint $table) {
            $table->id('timelineId');
            $table->unsignedBigInteger('tourId');
            $table->string('title');
            $table->text('description');
            $table->foreign('tourId')->references('tourId')->on('tbl_tours')->onDelete('cascade');
        });

        // 7. Booking (tbl_booking)
        Schema::create('tbl_booking', function (Blueprint $table) {
            $table->id('bookingId');
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('tourId');
            $table->string('fullName');
            $table->string('email');
            $table->string('phoneNumber');
            $table->string('address')->nullable();
            $table->integer('numAdults');
            $table->integer('numChildren');
            $table->decimal('totalPrice', 15, 2);
            $table->dateTime('bookingDate')->useCurrent();
            $table->char('bookingStatus', 1)->default('b'); // 'b': booked, 'c': cancelled, 'f': finished?
            $table->timestamps();

            $table->foreign('userId')->references('userId')->on('tbl_users')->onDelete('cascade');
            $table->foreign('tourId')->references('tourId')->on('tbl_tours')->onDelete('cascade');
        });

        // 8. Checkout (tbl_checkout)
        Schema::create('tbl_checkout', function (Blueprint $table) {
            $table->id('checkoutId');
            $table->unsignedBigInteger('bookingId');
            $table->decimal('amount', 15, 2);
            $table->string('paymentMethod');
            $table->char('paymentStatus', 1)->default('n'); // 'y' or 'n'
            $table->string('transactionId')->nullable();
            $table->timestamps();

            $table->foreign('bookingId')->references('bookingId')->on('tbl_booking')->onDelete('cascade');
        });

        // 9. Reviews (tbl_reviews)
        Schema::create('tbl_reviews', function (Blueprint $table) {
            $table->id('reviewId');
            $table->unsignedBigInteger('tourId');
            $table->unsignedBigInteger('userId');
            $table->integer('rating');
            $table->text('comment');
            $table->dateTime('timestamp')->useCurrent();

            $table->foreign('tourId')->references('tourId')->on('tbl_tours')->onDelete('cascade');
            $table->foreign('userId')->references('userId')->on('tbl_users')->onDelete('cascade');
        });

        // 10. Contact (tbl_contact)
        Schema::create('tbl_contact', function (Blueprint $table) {
            $table->id('contactId');
            $table->string('fullName');
            $table->string('email');
            $table->string('phoneNumber');
            $table->text('message');
            $table->char('isReply', 1)->default('n');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_contact');
        Schema::dropIfExists('tbl_reviews');
        Schema::dropIfExists('tbl_checkout');
        Schema::dropIfExists('tbl_booking');
        Schema::dropIfExists('tbl_timeline');
        Schema::dropIfExists('tbl_temp_images');
        Schema::dropIfExists('tbl_images');
        Schema::dropIfExists('tbl_tours');
        Schema::dropIfExists('tbl_users');
        Schema::dropIfExists('tbl_admin');
    }
};
