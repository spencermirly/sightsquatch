<?php

    enum Notify {
        case Default;
        case Success;
        case Fail;
    }
    class Widgets{
        public static function notify($message, $type = Notify::Default) {
            $message = htmlspecialchars($message);
            switch($type) {
                case Notify::Success:
                    return "<div class='notify-success'>$message</div>";
                case Notify::Fail:
                    return "<div class='notify-fail'>$message</div>";
                default:
                    return "<div class='notify'>$message</div>";
            }
        }

        public static function postEntry($id, $title, $poster, $location, $date, $comments) {
            $title = htmlspecialchars($title);
            $poster = htmlspecialchars($poster);
            $location = htmlspecialchars($location);
            $date = htmlspecialchars($date);
            $comments = htmlspecialchars($comments);
            return "
                <a class='post flex-row' href='post.php?post_id=$id'>
                    <div class='info expand'>
                    <h3>$title</h3>
                        <div class='metadata flex-row'>
                            <span class='name'>$poster</span>
                            <span class='expand'></span>
                            <span class='loc'>$location</span>
                            <span class='date'>$date</span>
                        </div>
                    </div>
                    <div class='comment-count flex-col'>
                        <img src=chat-left-text-fill.svg>
                        <span><strong>$comments</strong></span>
                    </div>
                </a>
            ";
        }

        public static function postEntryArr($array) {
            return Widgets::postEntry($array['id'], $array['title'], $array['username'], $array['sightingLoc'], $array['sightingDate'], $array['comments']);
        }
    }
?>