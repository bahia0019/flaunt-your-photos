<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://flauntyoursite.com
 * @since      1.0.0
 *
 * @package    Flaunt_Your_Photos
 * @subpackage Flaunt_Your_Photos/admin/partials
 */
?>

   <div class="fyp-container">
        <div class="header">

            <div class="header-left">

                <a href="#" id="upload-link">
                    <span>Hello bitches!</span>
                </a>

            </div>

            <div class="header-right">
                <a href="#" id="portal-link">
                    <span>Hello switches!</span>
                </a>
            </div>
            <a class="icon-settings" href="#">
                <svg id="icon-equalizer" viewBox="0 0 32 32">
                    <title>equalizer</title>
                    <path d="M14 4v-0.5c0-0.825-0.675-1.5-1.5-1.5h-5c-0.825 0-1.5 0.675-1.5 1.5v0.5h-6v4h6v0.5c0 0.825 0.675 1.5 1.5 1.5h5c0.825 0 1.5-0.675 1.5-1.5v-0.5h18v-4h-18zM8 8v-4h4v4h-4zM26 13.5c0-0.825-0.675-1.5-1.5-1.5h-5c-0.825 0-1.5 0.675-1.5 1.5v0.5h-18v4h18v0.5c0 0.825 0.675 1.5 1.5 1.5h5c0.825 0 1.5-0.675 1.5-1.5v-0.5h6v-4h-6v-0.5zM20 18v-4h4v4h-4zM14 23.5c0-0.825-0.675-1.5-1.5-1.5h-5c-0.825 0-1.5 0.675-1.5 1.5v0.5h-6v4h6v0.5c0 0.825 0.675 1.5 1.5 1.5h5c0.825 0 1.5-0.675 1.5-1.5v-0.5h18v-4h-18v-0.5zM8 28v-4h4v4h-4z"></path>
                </svg>
            </a>
        </div>
        <!-- End Header -->
        <div class="sorter">This div has everything...</div>

        <div class="fyp-photo-portal">
            <ul>
                <!-- Dynamically Generated Content -->
            </ul>
            <button class="load-more">Load More</button>
        </div>
        <div class="fyp-photo-upload">
            <div class="drop-area">
                <p>Drop your photos here.</p>
            </div>

        </div>

        <div class="control-panel">
            <div class="slidecontainer">
                <input type="range" min="5" max="18" value="10" class="slider" id="myRange">
            </div>

            <div class="slidecontainer">
                <input type="range" min="1" max="5" value="3" class="slider" id="slideLength">
            </div>

            <div class="switcher">
                <button id="photo-mode">Photos</button>
                <button id="slide-show-mode">Slide Show</button>
                <button id="something-else-mode">Something Else</button>
            </div>

            <div class="photo-mode">
                <div class="photo-meta">
                    <div>
                        <p class="photo-title-label">Title:</p>
                        <input type="text" name="photo-title" id="photo-title" value="">
                        <br>
                        <!-- Selected photo populates Title -->
                    </div>

                    <div>
                        <p class="photo-alt-label">Alt Text:</p>
                        <input type="text" name="photo-alt" id="photo-alt" value="">
                        <br>
                        <!-- Selected photo populates Title -->
                    </div>

                    <div>
                        <p class="photo-copyright">Copyright:</p>
                        <input type="text" name="photo-copyright" id="photo-copyright" value="">
                        <br>
                    </div>
                    <div>
                        <p class="photo-shutter">Shutter Speed:</p>
                        <input type="text" name="photo-shutter" id="photo-shutter" value="">
                        <br>
                    </div>
                    <div>
                        <p class="photo-aperture">Aperture:</p>
                        <input type="text" name="photo-aperture" id="photo-aperture" value="">
                        <br>
                    </div>

                </div>

                <div class="thumb-detail">
                    <img src="" />
                </div>

            </div>

            <div class="slide-show-mode">
                <div class="time-bar">
                    <div class="slides">
                        <p class="slide-time">Time</p>
                    </div>
                    <div class="audio-timeline">
                        <div class="song time-bar" draggable="true">
                            <p class="song-time">Song Name and Time</p>
                        </div>
                    </div>
                </div>

                <div class="thumb-detail">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <!-- Slides get added dynamically -->
                        </div>
                    </div>
                </div>
            </div>




            <div class="something-else-mode">
                <p>Ain't that something else, mutha fucka?</p>

                <div class="layout-template-1">
                    <div class="one" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 1">
                            <path d="M1 0H0v1h1V0z" opacity=".1" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>


    </div>