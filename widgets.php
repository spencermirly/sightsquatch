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

        public static function postEntry($title, $poster, $location, $date, $comments) {
            $title = htmlspecialchars($title);
            $poster = htmlspecialchars($poster);
            $location = htmlspecialchars($location);
            $date = htmlspecialchars($date);
            $comments = htmlspecialchars($comments);
            return "
                <div class='post flex-row'>
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
                </div>
            ";
        }

        public static function postEntryArr($array) {
            return Widgets::postEntry($array['title'], $array['username'], $array['sightingLoc'], $array['sightingDate'], $array['comments']);
        }
    }

    /*
    <div class="post flex-row">
                <div class="info expand">
                <h3>Example Post</h3>
                    <div class="metadata flex-row">
                        <span class="name">Example User</span>
                        <span class="expand"></span>
                        <span class="loc">Boise, ID</span>
                        <span class="date">1/27/2023</span>
                    </div>
                </div>
                <div class="comment-count flex-col">
                    <img src=chat-left-text-fill.svg>
                    <span><strong>12</strong></span>
                </div>
            </div>

    */

?>