<?php

namespace app\contracts;

interface AuthenticableModel
{
	/**
	 * Find identity by email
	 * @return AuthenticableModel
	 */
	public static function findByEmail($email);

	/**
	 * Get user email
	 * @return string
	 */
	public function getEmail();

	/**
	 * Get user id
	 * @return int
	 */
	public function getId();

	/**
	 * Get user role
	 * @return string
	 */
	public function getRole();

	/**
	 * Get user auth key
	 * @return string
	 */
	public function getAuthKey();

	/**
	 * Test passwords for equality
	 * @param string $password
	 * @return bool
	 */
	public function checkPassword($password);
}