<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddFaqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faqs = [
            [
                'question' => 'What is democracy?',
                'answer' => 'Democracy is an entertaining quiz app where users can participate in a variety of quizzes and have fun while earning rewards.',
            ],
            [
                'question' => 'How do I join a quiz?',
                'answer' => 'To join a quiz, navigate to the "Contests" section, select the quiz you\'re interested in, and tap on the "Enroll" button.',
            ],
            [
                'question' => 'Are the quiz questions based on facts or opinions?',
                'answer' => 'Our quizzes include questions that are subjective and based on opinions. It adds a fun and engaging element to the quiz experience.',
            ],
            [
                'question' => 'How are quiz winners determined?',
                'answer' => 'Winners are determined based on answers chosen by most of the people. A higher percentage of the option selected by overall participants will turn out to be the correct answer.',
            ],
            [
                'question' => 'Can I suggest a question for a quiz?',
                'answer' => 'Absolutely! Head to the home screen and look for the "Suggest a Question" section at the very bottom. We welcome your creative quiz ideas.',
            ],
        ];

        // Insert data into the faqs table
        DB::table('faqs')->insert($faqs);
    }
}
