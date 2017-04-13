<?php
/*
* In this file having all function detail information
* This is use for developer
* It will helps when application become large and try to avoid duplicate function for same data
*/

// Function getFeaturedDevelopemtBySlug($params)
	Name :: getFeaturedDevelopemtBySlug($slugName, $slugValue, $recordStarting, $recordEnd)
	e.g.,
	$slugName :: "is_featured"
	$slugValue :: "1"
	$recordStarting :: "0"
	$recordEnd :: "4"
	Use :: This function use to get featuredDevelopmentList. By using start and end record for number of parameters.
	Repository :: PropertyDetailRepository

// Function saveImageData($imageData)
	Name :: saveImageData($imageData)
	e.g.,
	$imageData :: "Array of all image information :: title, description, alt, url, id, status"
	Use :: This function use save/update image data to IMAGE table.
	Repository :: ImageRepository

// Function savePropertyImage($imageData)
	Name :: savePropertyImage($imageData)
	e.g.,
	$imageData :: "Array of all property image information :: property_id, image_id, image_for, etc"
	Use :: This function use save/update property image data to PROPERTY IMAGE table.
	Repository :: PropertyImageRepository

// Function getUserProfilePhoto($userId, $size)
	Name :: getUserProfilePhoto($userId, $size)
	e.g.,
	$userId :: "User Id"
	$size :: "Size of image :: thumb, icon, original any"
	Use :: This function use to get user's profile photo with complete url and passing size as a second parameter to get your wishlist size of image.
	Helper :: getUserProfilePhoto

// Function getPropertyUsingSlugAndActionTypeId($slugName, $actionTypeId)
	Name :: getPropertyUsingSlugAndActionTypeId($slugName, $actionTypeId)
	e.g.,
	$slugName :: "property_name"
	$actionTypeId :: "1/2/3" "(Group/Deal/Development)"
	Use :: This function use to get property list using slug name and action type ID. If you wan to use this function to get property record vice versa.
	Repository :: PropertyDetailRepository

