<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionToursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define realistic tour data for 3 regions
        $tours = [
            // --- MIỀN BẮC (NORTH) ---
            [
                'title' => 'Tour Hà Giang - Lũng Cú - Sông Nho Quế',
                'description' => 'Khám phá cao nguyên đá Đồng Văn hùng vĩ, cột cờ Lũng Cú thiêng liêng và trải nghiệm đi thuyền trên sông Nho Quế xanh biếc. Thưởng thức đặc sản vùng cao và tìm hiểu văn hóa người Mông.',
                'priceAdult' => 2850000,
                'priceChild' => 1425000,
                'time' => '3 ngày 2 đêm',
                'destination' => 'Hà Giang',
                'quantity' => 25,
                'availability' => 1,
                'domain' => 'b',
                'startDate' => now()->addDays(7),
                'endDate' => now()->addDays(10),
                'images' => [
                    ['url' => 'hagiang.jpg', 'desc' => 'Cao nguyên đá Đồng Văn'],
                    ['url' => 'nhoque.jpg', 'desc' => 'Sông Nho Quế'],
                    ['url' => 'lungcu.jpg', 'desc' => 'Cột cờ Lũng Cú']
                ],
                'timeline' => [
                    ['title' => 'Ngày 1', 'desc' => 'Hà Nội - Quản Bạ - Yên Minh. Check-in cổng trời Quản Bạ, núi đôi Cô Tiên.'],
                    ['title' => 'Ngày 2', 'desc' => 'Yên Minh - Lũng Cú - Đồng Văn. Thăm dinh vua Mèo, cột cờ Lũng Cú, phố cổ Đồng Văn.'],
                    ['title' => 'Ngày 3', 'desc' => 'Đồng Văn - Mã Pí Lèng - Sông Nho Quế - Hà Nội. Đi thuyền trên sông Nho Quế, chinh phục đèo Mã Pí Lèng.']
                ]
            ],
            [
                'title' => 'Tour Hạ Long - Ngủ Đêm Du Thuyền 5 Sao',
                'description' => 'Trải nghiệm đẳng cấp trên du thuyền 5 sao giữa lòng di sản thiên nhiên thế giới Vịnh Hạ Long. Chèo kayak, thăm hang Sửng Sốt và ngắm bình minh trên biển.',
                'priceAdult' => 3200000,
                'priceChild' => 1600000,
                'time' => '2 ngày 1 đêm',
                'destination' => 'Hạ Long',
                'quantity' => 30,
                'availability' => 1,
                'domain' => 'b',
                'startDate' => now()->addDays(5),
                'endDate' => now()->addDays(7),
                'images' => [
                    ['url' => 'halong.jpg', 'desc' => 'Toàn cảnh Vịnh Hạ Long'],
                    ['url' => 'cruise.jpg', 'desc' => 'Du thuyền sang trọng'],
                    ['url' => 'kayak.jpg', 'desc' => 'Chèo Kayak khám phá hang động']
                ],
                'timeline' => [
                    ['title' => 'Ngày 1', 'desc' => 'Hà Nội - Hạ Long. Check-in du thuyền, ăn trưa buffet, thăm hang Sửng Sốt.'],
                    ['title' => 'Ngày 2', 'desc' => 'Hạ Long - Hà Nội. Tập Taichi, chèo Kayak tại hang Luồn, tham quan đảo Ti Tốp.']
                ]
            ],
            [
                'title' => 'Tour Sapa - Fansipan - Bản Cát Cát',
                'description' => 'Chinh phục nóc nhà Đông Dương Fansipan, săn mây Sapa và hòa mình vào cuộc sống bình yên của bản làng Tây Bắc. Check-in Swing Sapa và nhà thờ đá.',
                'priceAdult' => 2500000,
                'priceChild' => 1250000,
                'time' => '3 ngày 2 đêm',
                'destination' => 'Sapa',
                'quantity' => 20,
                'availability' => 1,
                'domain' => 'b',
                'startDate' => now()->addDays(12),
                'endDate' => now()->addDays(15),
                'images' => [
                    ['url' => 'sapa.jpg', 'desc' => 'Thị trấn Sapa mờ sương'],
                    ['url' => 'fansipan.jpg', 'desc' => 'Chinh phục đỉnh Fansipan'],
                    ['url' => 'catcat.jpg', 'desc' => 'Bản Cát Cát']
                ],
                'timeline' => [
                    ['title' => 'Ngày 1', 'desc' => 'Hà Nội - Sapa - Hàm Rồng. Ngắm toàn cảnh thị trấn Sapa từ trên cao.'],
                    ['title' => 'Ngày 2', 'desc' => 'Sapa - Fansipan - Bản Cát Cát. Đi cáp treo chinh phục đỉnh Fansipan.'],
                    ['title' => 'Ngày 3', 'desc' => 'Sapa - Thác Bạc - Hà Nội. Thăm quan Thác Bạc và mua sắm đặc sản.']
                ]
            ],

            // --- MIỀN TRUNG (CENTRAL) ---
            [
                'title' => 'Tour Đà Nẵng - Hội An - Bà Nà Hills',
                'description' => 'Hành trình di sản miền Trung. Khám phá thành phố đáng sống Đà Nẵng, phố cổ Hội An rêu phong và thiên đường giải trí Bà Nà Hills với Cầu Vàng nổi tiếng.',
                'priceAdult' => 3990000,
                'priceChild' => 1995000,
                'time' => '4 ngày 3 đêm',
                'destination' => 'Đà Nẵng',
                'quantity' => 40,
                'availability' => 1,
                'domain' => 't',
                'startDate' => now()->addDays(15),
                'endDate' => now()->addDays(19),
                'images' => [
                    ['url' => 'cauvang.jpg', 'desc' => 'Cầu Vàng Bà Nà Hills'],
                    ['url' => 'hoian.jpg', 'desc' => 'Phố cổ Hội An về đêm'],
                    ['url' => 'caurong.jpg', 'desc' => 'Cầu Rồng phun lửa']
                ],
                'timeline' => [
                    ['title' => 'Ngày 1', 'desc' => 'Đón sân bay - Bán đảo Sơn Trà - Ngũ Hành Sơn. Thăm chùa Linh Ứng.'],
                    ['title' => 'Ngày 2', 'desc' => 'Đà Nẵng - Bà Nà Hills. Trải nghiệm cáp treo, làng Pháp và Fantasy Park.'],
                    ['title' => 'Ngày 3', 'desc' => 'Đà Nẵng - Cù Lao Chàm - Hội An. Lặn ngắm san hô và dạo chơi phố cổ.'],
                    ['title' => 'Ngày 4', 'desc' => 'Mua sắm đặc sản miền Trung - Tiễn sân bay.']
                ]
            ],
            [
                'title' => 'Tour Huế - Động Thiên Đường - Phong Nha',
                'description' => 'Ngược dòng lịch sử thăm Cố đô Huế mộng mơ, khám phá vẻ đẹp kỳ vĩ của Động Thiên Đường và Động Phong Nha kẻ Bàng - di sản thiên nhiên thế giới.',
                'priceAdult' => 2950000,
                'priceChild' => 1475000,
                'time' => '3 ngày 2 đêm',
                'destination' => 'Huế',
                'quantity' => 25,
                'availability' => 1,
                'domain' => 't',
                'startDate' => now()->addDays(8),
                'endDate' => now()->addDays(11),
                'images' => [
                    ['url' => 'daihoihue.jpg', 'desc' => 'Đại Nội Huế'],
                    ['url' => 'dongthienduong.jpg', 'desc' => 'Động Thiên Đường lung linh'],
                    ['url' => 'langkhai dinh.jpg', 'desc' => 'Lăng Khải Định']
                ],
                'timeline' => [
                    ['title' => 'Ngày 1', 'desc' => 'Huế - Đại Nội - Chùa Thiên Mụ. Nghe ca Huế trên sông Hương.'],
                    ['title' => 'Ngày 2', 'desc' => 'Huế - Quảng Bình - Động Thiên Đường. Chinh phục hoàng cung trong lòng đất.'],
                    ['title' => 'Ngày 3', 'desc' => 'Quảng Bình - Vũng Chùa - Huế. Viếng mộ Đại tướng Võ Nguyên Giáp.']
                ]
            ],
            [
                'title' => 'Tour Quy Nhơn - Kỳ Co - Eo Gió',
                'description' => 'Khám phá thiên đường biển đảo Quy Nhơn hoang sơ và quyến rũ. Check-in Eo Gió - nơi ngắm bình minh đẹp nhất Việt Nam và tắm biển tại bãi Kỳ Co nước xanh ngọc bích.',
                'priceAdult' => 3100000,
                'priceChild' => 1550000,
                'time' => '3 ngày 2 đêm',
                'destination' => 'Quy Nhơn',
                'quantity' => 20,
                'availability' => 1,
                'domain' => 't',
                'startDate' => now()->addDays(20),
                'endDate' => now()->addDays(23),
                'images' => [
                    ['url' => 'kyco.jpg', 'desc' => 'Bãi biển Kỳ Co'],
                    ['url' => 'eogio.jpg', 'desc' => 'Eo Gió Quy Nhơn'],
                    ['url' => 'thapdoi.jpg', 'desc' => 'Tháp Đôi Chăm Pa']
                ],
                'timeline' => [
                    ['title' => 'Ngày 1', 'desc' => 'Đón sân bay - Bảo tàng Quang Trung - Tháp Đôi.'],
                    ['title' => 'Ngày 2', 'desc' => 'Quy Nhơn - Kỳ Co - Eo Gió. Trải nghiệm lặn ngắm san hô.'],
                    ['title' => 'Ngày 3', 'desc' => 'Ghềnh Ráng Tiên Sa - Trại Phong Quy Hòa - Tiễn sân bay.']
                ]
            ],

            // --- MIỀN NAM (SOUTH) ---
            [
                'title' => 'Tour Phú Quốc - Grand World - VinWonders',
                'description' => 'Nghỉ dưỡng tại đảo ngọc Phú Quốc. Vui chơi thả ga tại VinWonders và Safari, check-in thành phố không ngủ Grand World và ngắm hoàng hôn tại Sunset Sanato.',
                'priceAdult' => 5500000,
                'priceChild' => 2750000,
                'time' => '3 ngày 2 đêm',
                'destination' => 'Phú Quốc',
                'quantity' => 35,
                'availability' => 1,
                'domain' => 'n',
                'startDate' => now()->addDays(10),
                'endDate' => now()->addDays(13),
                'images' => [
                    ['url' => 'grandworld.jpg', 'desc' => 'Grand World Phú Quốc'],
                    ['url' => 'sao_beach.jpg', 'desc' => 'Bãi Sao Phú Quốc'],
                    ['url' => 'vinwonders.jpg', 'desc' => 'Công viên chủ đề VinWonders']
                ],
                'timeline' => [
                    ['title' => 'Ngày 1', 'desc' => 'Đón sân bay - Sunset Sanato - Chợ đêm Phú Quốc.'],
                    ['title' => 'Ngày 2', 'desc' => 'Khám phá Nam Đảo - Cáp treo Hòn Thơm - Bãi Sao.'],
                    ['title' => 'Ngày 3', 'desc' => 'Vinpearl Safari - VinWonders - Tiễn sân bay.']
                ]
            ],
            [
                'title' => 'Tour Miền Tây - Cần Thơ - Chợ Nổi Cái Răng',
                'description' => 'Về miền Tây sông nước, tham quan chợ nổi Cái Răng tấp nập, vườn trái cây sai trĩu quả và rừng tràm Trà Sư xanh mướt. Thưởng thức đặc sản lẩu mắm, cá lóc nướng trui.',
                'priceAdult' => 2200000,
                'priceChild' => 1100000,
                'time' => '2 ngày 1 đêm',
                'destination' => 'Cần Thơ',
                'quantity' => 30,
                'availability' => 1,
                'domain' => 'n',
                'startDate' => now()->addDays(6),
                'endDate' => now()->addDays(8),
                'images' => [
                    ['url' => 'cairang.jpg', 'desc' => 'Chợ nổi Cái Răng'],
                    ['url' => 'rungtram.jpg', 'desc' => 'Rừng tràm Trà Sư'],
                    ['url' => 'vuontraicay.jpg', 'desc' => 'Miệt vườn trái cây']
                ],
                'timeline' => [
                    ['title' => 'Ngày 1', 'desc' => 'Sài Gòn - Mỹ Tho - Bến Tre - Cần Thơ. Đi thuyền trên sông Tiền.'],
                    ['title' => 'Ngày 2', 'desc' => 'Cần Thơ - Chợ nổi Cái Răng - Lò hủ tiếu - Sài Gòn.']
                ]
            ],
            [
                'title' => 'Tour Côn Đảo - Tâm Linh & Nghỉ Dưỡng',
                'description' => 'Hành trình về nguồn thăm mộ chị Võ Thị Sáu linh thiêng. Khám phá thiên nhiên hoang sơ của Côn Đảo với bãi Đầm Trầu, bãi Nhát và Miếu Bà Phi Yến.',
                'priceAdult' => 4800000,
                'priceChild' => 2400000,
                'time' => '3 ngày 2 đêm',
                'destination' => 'Côn Đảo',
                'quantity' => 15,
                'availability' => 1,
                'domain' => 'n',
                'startDate' => now()->addDays(18),
                'endDate' => now()->addDays(21),
                'images' => [
                    ['url' => 'condao.jpg', 'desc' => 'Biển xanh Côn Đảo'],
                    ['url' => 'hangduong.jpg', 'desc' => 'Nghĩa trang Hàng Dương'],
                    ['url' => 'miueba.jpg', 'desc' => 'Miếu Bà Phi Yến']
                ],
                'timeline' => [
                    ['title' => 'Ngày 1', 'desc' => 'Đón sân bay Côn Sơn - Trại tù Phú Hải - Chuồng cọp Pháp.'],
                    ['title' => 'Ngày 2', 'desc' => 'Viếng nghĩa trang Hàng Dương - Mộ Cô Sáu - Tắm biển bãi Đầm Trầu.'],
                    ['title' => 'Ngày 3', 'desc' => 'Mua sắm đặc sản hạt bàng - Tiễn sân bay.']
                ]
            ]
        ];

        // --- SEEDING LOGIC ---
        // Get a valid user ID for reviews (assuming at least 1 user exists or create one)
        $userId = DB::table('tbl_users')->value('userId');
        if (!$userId) {
            $userId = DB::table('tbl_users')->insertGetId([
                'username' => 'seeded_user',
                'password' => '123456',
                'email' => 'seeded@example.com',
                'fullName' => 'Seeded User',
                'isActive' => 'y',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        foreach ($tours as $t) {
            // 1. Insert Tour
            $tourData = [
                'title' => $t['title'],
                'description' => $t['description'],
                'priceAdult' => $t['priceAdult'],
                'priceChild' => $t['priceChild'],
                'time' => $t['time'],
                'destination' => $t['destination'],
                'quantity' => $t['quantity'],
                'availability' => $t['availability'],
                'domain' => $t['domain'],
                'startDate' => $t['startDate'],
                'endDate' => $t['endDate'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $tourId = DB::table('tbl_tours')->insertGetId($tourData);

            // 2. Insert Images
            foreach ($t['images'] as $img) {
                DB::table('tbl_images')->insert([
                    'tourId' => $tourId,
                    'imageUrl' => $img['url'],
                    'description' => $img['desc']
                ]);
            }

            // 3. Insert Timeline
            foreach ($t['timeline'] as $line) {
                DB::table('tbl_timeline')->insert([
                    'tourId' => $tourId,
                    'title' => $line['title'],
                    'description' => $line['desc']
                ]);
            }

            // 4. Insert Random Reviews (Optional)
            if (rand(0, 1)) {
                DB::table('tbl_reviews')->insert([
                    'tourId' => $tourId,
                    'userId' => $userId,
                    'rating' => rand(4, 5), // Good tours
                    'comment' => 'Tour rất tuyệt vời, hướng dẫn viên nhiệt tình!',
                    'timestamp' => now()->subDays(rand(1, 10))
                ]);
            }
        }
    }
}
