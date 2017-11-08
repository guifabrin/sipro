<?php

namespace App\Http\Controllers;

class ImageController extends Controller {

	public function convert64($path) {
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		return $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
	}

	//https://davidwalsh.name/create-image-thumbnail-php
	public function makeThumb($src, $dest, $desired_width) {

		/* read the source image */
		$source_image = imagecreatefromjpeg($src);
		$width = imagesx($source_image);
		$height = imagesy($source_image);

		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height * ($desired_width / $width));

		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);

		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

		/* create the physical thumbnail image to its destination */
		imagejpeg($virtual_image, $dest);
	}

}
