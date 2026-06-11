<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Comment;
use App\Notifications\NewCommentNotification;

class NewCommentNotificationTest extends TestCase
{
    public function test_writer_receives_mail()
    {
        $writer = new User([
            'role' => 'writer'
        ]);

        $notification =
            new NewCommentNotification(
                new Comment()
            );

        $this->assertEquals(
            ['mail'],
            $notification->via($writer)
        );
    }

    public function test_admin_receives_database()
    {
        $admin = new User([
            'role' => 'admin'
        ]);

        $notification =
            new NewCommentNotification(
                new Comment()
            );

        $this->assertEquals(
            ['database'],
            $notification->via($admin)
        );
    }
}