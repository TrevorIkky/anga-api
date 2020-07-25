<?php

use App\Models\Subtopic;
use App\Models\Topic;
use Illuminate\Database\Seeder;


class SubtopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subtopics = array(
            "weather" => [
                "Humidity",
                "Sunshine",
                "Earthquakes"
            ]
        );
        foreach ($subtopics as $subtopickey => $value) {
            $topicId = Topic::where('topic', $subtopickey)->get()->pluck('topic_id')[0];
            foreach ($value as $key => $value) {
                Subtopic::create([
                    'topic_id'=>$topicId,
                    'subtopic'=>$value
                ]);
            }
        }
    }
}
