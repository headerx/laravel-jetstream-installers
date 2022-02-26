<?php

use HeaderX\JetstreamInstallers\Facades\JetstreamInstallers;

it('should show error if file does not exist', function () {
    $response = JetstreamInstallers::insertLine($this->nonExistentFilePath, "", "");

    $this->assertEquals("The file doesn't exists!", $response);
});
