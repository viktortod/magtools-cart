<?php
	interface IModule {
		public function init(array $settings);
		
		public function registerPackages();
	}