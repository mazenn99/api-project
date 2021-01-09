<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(ContactUsSeeder::class);
        $this->call(FavoriteSeeder::class);
        $this->call(QaAnswerSeeder::class);
        $this->call(QaVotesAnswerSeeder::class);
        $this->call(QaVotesSeeder::class);
        $this->call(ReportUsSeeder::class);
    }
}
