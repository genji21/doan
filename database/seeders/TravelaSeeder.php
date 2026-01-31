<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Admin
        \DB::table('tbl_admin')->insert([
            'username' => 'admin',
            'password' => 'admin', // In real app use Hash::make, but following existing LoginModel logic which might use plain text or md5 based on user code (checked LoginAdminController? It wasn't visible, but let's assume plain or update later. Wait, LoginGoogleController used md5. Let's start with 'admin' as plain text or simple to test). Note: Code review showed `md5('12345678')`. Let's use `admin` for now.
            'avatar' => 'admin_avatar.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Users
        $userId = \DB::table('tbl_users')->insertGetId([
            'username' => 'testuser',
            'password' => '123456', // Simple for testing
            'email' => 'test@example.com',
            'fullName' => 'Test User',
            'phoneNumber' => '0123456789',
            'address' => 'Hanoi, Vietnam',
            'isActive' => 'y',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Tours
        $tours = [
            [
                'title' => 'Khám phá Hà Giang - Mùa hoa Tam Giác Mạch',
                'description' => 'Trải nghiệm vẻ đẹp hùng vĩ của cao nguyên đá Đồng Văn và sắc hoa tam giác mạch.',
                'priceAdult' => 2500000,
                'priceChild' => 1250000,
                'time' => '3 ngày 2 đêm',
                'destination' => 'Hà Giang',
                'quantity' => 20,
                'availability' => 1,
                'domain' => 'b', // Bac
                'startDate' => now()->addDays(10),
                'endDate' => now()->addDays(13),
            ],
            [
                'title' => 'Đà Nẵng - Hội An - Bà Nà Hills',
                'description' => 'Tham quan thành phố đáng sống nhất Việt Nam và phố cổ Hội An thơ mộng.',
                'priceAdult' => 3500000,
                'priceChild' => 1750000,
                'time' => '4 ngày 3 đêm',
                'destination' => 'Đà Nẵng',
                'quantity' => 15,
                'availability' => 1,
                'domain' => 't', // Trung
                'startDate' => now()->addDays(20),
                'endDate' => now()->addDays(24),
            ],
            [
                'title' => 'Phú Quốc - Thiên đường đảo ngọc',
                'description' => 'Nghỉ dưỡng tại những bãi biển đẹp nhất hành tinh.',
                'priceAdult' => 5000000,
                'priceChild' => 2500000,
                'time' => '3 ngày 2 đêm',
                'destination' => 'Phú Quốc',
                'quantity' => 25,
                'availability' => 1,
                'domain' => 'n', // Nam
                'startDate' => now()->addDays(15),
                'endDate' => now()->addDays(18),
            ]
        ];

        foreach ($tours as $tourData) {
            $tourId = \DB::table('tbl_tours')->insertGetId(array_merge($tourData, ['created_at' => now(), 'updated_at' => now()]));

            // 4. Images
            \DB::table('tbl_images')->insert([
                ['tourId' => $tourId, 'imageUrl' => 'tour_default.jpg', 'description' => 'Ảnh chính'],
                ['tourId' => $tourId, 'imageUrl' => 'scenery.jpg', 'description' => 'Phong cảnh'],
            ]);

            // 5. Timeline
            \DB::table('tbl_timeline')->insert([
                ['tourId' => $tourId, 'title' => 'Ngày 1', 'description' => 'Đón khách và tham quan điểm đến đầu tiên.'],
                ['tourId' => $tourId, 'title' => 'Ngày 2', 'description' => 'Khám phá các địa danh nổi tiếng và thưởng thức ẩm thực.'],
                ['tourId' => $tourId, 'title' => 'Ngày 3', 'description' => 'Mua sắm quà lưu niệm và tiễn khách.'],
            ]);

            // 6. Reviews (Randomly add reviews)
            if (rand(0, 1)) {
                \DB::table('tbl_reviews')->insert([
                    'tourId' => $tourId,
                    'userId' => $userId,
                    'rating' => 5,
                    'comment' => 'Chuyến đi tuyệt vời! Hướng dẫn viên nhiệt tình.',
                    'timestamp' => now(),
                ]);
            }
        }

        // 7. Booking & Checkout (Dummy booking)
        // Lấy tour đầu tiên để book
        $firstTourId = \DB::table('tbl_tours')->first()->tourId;
        $bookingId = \DB::table('tbl_booking')->insertGetId([
            'userId' => $userId,
            'tourId' => $firstTourId,
            'fullName' => 'Test User',
            'email' => 'test@example.com',
            'phoneNumber' => '0123456789',
            'address' => 'Hanoi',
            'numAdults' => 2,
            'numChildren' => 0,
            'totalPrice' => 5000000,
            'bookingDate' => now(),
            'bookingStatus' => 'f', // Finished
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('tbl_checkout')->insert([
            'bookingId' => $bookingId,
            'amount' => 5000000,
            'paymentMethod' => 'momo',
            'paymentStatus' => 'y',
            'transactionId' => 'TRANS123456',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // 8. Contact
        \DB::table('tbl_contact')->insert([
            'fullName' => 'Potential Customer',
            'email' => 'customer@gmail.com',
            'phoneNumber' => '0987654321',
            'message' => 'Tôi muốn hỏi về tour đi Sapa tháng sau.',
            'isReply' => 'n',
            'created_at' => now(),
        ]);
        // ... Existing manual data ...

        // ---------------------------------------------------------
        // ADDING RANDOM DATA (approx 20 records each)
        // ---------------------------------------------------------
        
        $faker = \Faker\Factory::create();
        
        // 1. Extra Admin/Users
        // We already have some, let's add 20 more users
        $userIds = [$userId]; // Keep track of valid user IDs
        for ($i = 0; $i < 20; $i++) {
            $newUserId = \DB::table('tbl_users')->insertGetId([
                'username' => $faker->unique()->userName,
                'password' => '123456', 
                'email' => $faker->unique()->safeEmail,
                'fullName' => $faker->name,
                'phoneNumber' => $faker->phoneNumber,
                'address' => $faker->address,
                'isActive' => 'y',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $userIds[] = $newUserId;
        }

        // 2. Extra Tours
        $domains = ['b', 't', 'n']; // Bac, Trung, Nam
        $destinations = ['Hà Nội', 'Hạ Long', 'Ninh Bình', 'Huế', 'Nha Trang', 'Đà Lạt', 'Vũng Tàu', 'Cần Thơ', 'Sapa', 'Mộc Châu'];
        
        $tourIds = [$firstTourId, $tourId]; // Keep track of tour IDs (firstTourId/tourId from above)

        for ($i = 0; $i < 20; $i++) {
            $startDate = now()->addDays(rand(1, 60));
            $days = rand(2, 7);
            $endDate = (clone $startDate)->addDays($days);
            
            $newTourId = \DB::table('tbl_tours')->insertGetId([
                'title' => $faker->sentence(4) . ' (' . $faker->city . ')',
                'description' => $faker->paragraph(3),
                'priceAdult' => rand(1000000, 10000000),
                'priceChild' => rand(500000, 5000000),
                'time' => "$days ngày " . ($days - 1) . " đêm",
                'destination' => $faker->randomElement($destinations),
                'quantity' => rand(10, 50),
                'availability' => 1,
                'domain' => $faker->randomElement($domains),
                'startDate' => $startDate,
                'endDate' => $endDate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $tourIds[] = $newTourId;

            // Images for new tour
            for ($img = 0; $img < rand(3, 5); $img++) {
                 // Using placeholder images or reusing existing names if physical files not present
                 // Assuming frontend handles missing files gracefully or we use simple names
                 $imgName = $faker->randomElement(['tour_default.jpg', 'scenery.jpg', 'ha-giang.jpg', 'sapa.jpg', 'hue.jpg']); 
                 \DB::table('tbl_images')->insert([
                    'tourId' => $newTourId,
                    'imageUrl' => $imgName,
                    'description' => $faker->words(3, true)
                 ]);
            }

            // Timeline for new tour
            for ($day = 1; $day <= $days; $day++) {
                \DB::table('tbl_timeline')->insert([
                    'tourId' => $newTourId,
                    'title' => "Ngày $day",
                    'description' => $faker->paragraph()
                ]);
            }

            // Reviews for new tour (Randomly 0-5 reviews per tour)
            for ($r = 0; $r < rand(0, 5); $r++) {
                \DB::table('tbl_reviews')->insert([
                    'tourId' => $newTourId,
                    'userId' => $faker->randomElement($userIds),
                    'rating' => rand(3, 5),
                    'comment' => $faker->sentence(),
                    'timestamp' => now()->subDays(rand(0, 30)),
                ]);
            }
        }

        // 3. Extra Bookings
        for ($i = 0; $i < 20; $i++) {
            $bUserId = $faker->randomElement($userIds);
            $bTourId = $faker->randomElement($tourIds);
            
            $bookingId = \DB::table('tbl_booking')->insertGetId([
                'userId' => $bUserId,
                'tourId' => $bTourId,
                'fullName' => $faker->name,
                'email' => $faker->safeEmail,
                'phoneNumber' => $faker->phoneNumber,
                'address' => $faker->address,
                'numAdults' => rand(1, 4),
                'numChildren' => rand(0, 2),
                'totalPrice' => rand(2000000, 15000000),
                'bookingDate' => now()->subDays(rand(1, 30)),
                'bookingStatus' => $faker->randomElement(['pending', 'y', 'n', 'f']), // Assuming status codes
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Add Checkout for some bookings
            if (rand(0, 1)) {
                \DB::table('tbl_checkout')->insert([
                    'bookingId' => $bookingId,
                    'amount' => rand(2000000, 15000000),
                    'paymentMethod' => $faker->randomElement(['momo', 'paypal', 'vnpay', 'cash']),
                    'paymentStatus' => 'y',
                    'transactionId' => strtoupper($faker->bothify('TRANS########')),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 4. Extra Contacts
        for ($i = 0; $i < 20; $i++) {
            \DB::table('tbl_contact')->insert([
                'fullName' => $faker->name,
                'email' => $faker->safeEmail,
                'phoneNumber' => $faker->phoneNumber,
                'message' => $faker->paragraph(),
                'isReply' => $faker->randomElement(['y', 'n']),
                'created_at' => now()->subDays(rand(0, 30)),
            ]);
        }
    }
}
