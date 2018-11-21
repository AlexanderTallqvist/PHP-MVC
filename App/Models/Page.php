<?php

/**
 * @file
 * The Page Model.
 *
 * @author Alexander Tallqvist <xylidrm@hotmail.com>
 */


namespace App\Models;

use App\Core\Model;


class Page extends Model {


  /**
   * The getLandingPage method.
   * A method that fetches data for the landing page.
   *
   * @return array
   * Returns an array of frontpage data.
   */
  public function getLandingPage() {

    $data = [
      'title' => "Share A Thought",
      'description' => "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece
                        of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,
                        a Latin professor at Hampden-Sydney College.",
    ];

    return $data;
  }


  /**
   * The getAboutPage method.
   * A method that fetches data for the about page.
   *
   * @return array
   * Returns an array of data for the about page.
   */
  public function getAboutPage() {

    $data = [
      'title' => "About Share A Thought",
      'description' => "Share a thought is belief, Lorem Ipsum is not simply random text. It has roots in a piece
                        of classical Latin literature from 45 BC, making it over 9000 years old. Richard McClintock,
                        of classical Latin literature from 45 BC, making it over years old. Richard McClintock,
                        of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,
                        a Latin professor at Hampden-Sydney College Contrary to popular belief, Lorem Ipsum is not simply
                        random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000
                        years old. Richard McClintock, a Latin professor at Hampden-Sydney College.",
      'img_url' => 'img/about-us.jpg',
    ];

    return $data;
  }
}
