<?php

class MessagesTableSeeder extends DatabaseSeeder {

    public function run()
    {
        $messages = array(
            array(
                'title'  => 'Soyons bouleversés par l\'amour de Dieu !',
                'passage'=> 'Jean 3.14-18',
                'url'    => 'NDclr6wn1Yv0DL9',
                'date'   => '2014-05-25'
            ),
            array(
                'title'  => 'Le juste, que ferait-il ?',
                'passage'=> 'Psaume 11',
                'url'    => 'uaJFjJ1IUMWAKcc',
                'date'   => '2014-06-01'
            ),
            array(
                'title'  => 'Prions les uns pour les autres',
                'passage'=> 'Colossiens 4.7-18',
                'url'    => '8pQrA7jeYXixSWX',
                'date'   => '2014-06-08'
            ),
            array(
                'title'  => 'Imitons l\'exemple de Job !',
                'passage'=> 'Job 1-2',
                'url'    => '45KjrLta9OuEuAC',
                'date'   => '2014-06-15'
            ),
            array(
                'title'  => 'Où sont les fleuves d\'eau vive ?',
                'passage'=> 'Jean 7.37-39',
                'url'    => 'Lx27MyV2hq8e7J0',
                'date'   => '2014-06-22'
            ),
            array(
                'title'  => 'Du fruit en abondance',
                'passage'=> 'Jean 15.1-6',
                'url'    => 'p4pXUsvKpdsJ1AK',
                'date'   => '2014-06-29'
            ),
            array(
                'title'  => 'Manifestons la foi d\'Abraham !',
                'passage'=> 'Genèse 22.1-18',
                'url'    => '8gp6GQSAKZTccIO',
                'date'   => '2014-07-06'
            ),
            array(
                'title'  => 'Quel est l\'objet de vos pensées ?',
                'passage'=> 'Philippiens 4.8',
                'url'    => 'iNFxz1c3YL3AqT8',
                'date'   => '2014-07-13'
            ),
            array(
                'title'  => 'Une image juste de Dieu',
                'passage'=> 'Esaïe 45.14-25',
                'url'    => 'PjZtWdhpH9c9Fcz',
                'date'   => '2014-07-20'
            )
        );
        foreach($messages as $key => $value)
        {
            $m = new App\Models\Message;
            $m->member_id  = 1;
            $m->title      = $value['title'];
            $m->passage    = $value['passage'];
            $m->url        = $value['url'];
            $m->date       = $value['date'];
            $m->created_by = 1;
            $m->updated_by = 1;
            $m->save();
        }
    }

}
