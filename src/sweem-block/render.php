<?php
$name        = isset( $attributes['name'] ) ? $attributes['name'] : '';
$designation = isset( $attributes['designation'] ) ? $attributes['designation'] : '';
$img_url     = isset( $attributes['imgUrl'] ) ? trim( (string) $attributes['imgUrl'] ) : '';
$img_id      = isset( $attributes['imgId'] ) ? (int) $attributes['imgId'] : 0;
$img_alt     = isset( $attributes['imgAlt'] ) ? $attributes['imgAlt'] : $name;
$skin_style  = isset( $attributes['skinStyle'] ) ? $attributes['skinStyle'] : 'style1';
$allowed_skins = array( 'style1', 'style2', 'style3', 'style4' );
if ( ! in_array( $skin_style, $allowed_skins, true ) ) {
	$skin_style = 'style1';
}
$theme_class = 'sweem-current-theme' . str_replace( 'style', '', $skin_style );

if ( $img_id > 0 ) {
	$resolved_img_url = wp_get_attachment_image_url( $img_id, 'full' );
	if ( ! empty( $resolved_img_url ) ) {
		$img_url = $resolved_img_url;
	}
}

if ( ! function_exists( 'sweem_block_normalize_image_url' ) ) {
	function sweem_block_normalize_image_url( $url ) {
		$url = trim( (string) $url );
		if ( '' === $url ) {
			return '';
		}
		if ( 0 === strpos( $url, 'data:' ) ) {
			return $url;
		}
		if ( 0 === strpos( $url, '//' ) ) {
			$url = set_url_scheme( $url, is_ssl() ? 'https' : 'http' );
		} elseif ( 0 === strpos( $url, '/wp-content/' ) ) {
			$url = home_url( $url );
		} elseif ( 0 === strpos( $url, 'wp-content/' ) ) {
			$url = home_url( '/' . $url );
		}
		return esc_url( $url );
	}
}

$img_url = sweem_block_normalize_image_url( $img_url );

if ( ! function_exists( 'sweem_block_normalize_url' ) ) {
	function sweem_block_normalize_url( $url ) {
		$url = trim( (string) $url );
		if ( '' === $url ) {
			return '';
		}
		if ( '#' === $url ) {
			return '#';
		}
		if ( 0 !== strpos( $url, 'http://' ) && 0 !== strpos( $url, 'https://' ) ) {
			$url = 'https://' . ltrim( $url, '/' );
		}
		return esc_url( $url );
	}
}

if ( ! function_exists( 'sweem_block_render_social_links' ) ) {
	function sweem_block_render_social_links( $social_items ) {
		foreach ( $social_items as $social_item ) {
			if ( empty( $social_item['url'] ) ) {
				continue;
			}
			?>
			<a class="sweem-social-link" aria-label="<?php echo esc_attr( $social_item['icon'] ); ?>" href="<?php echo esc_url( $social_item['url'] ); ?>" target="_blank" rel="noopener noreferrer">
				<i class="fa fa-<?php echo esc_attr( $social_item['icon'] ); ?>" aria-hidden="true"></i>
			</a>
			<?php
		}
	}
}

if ( ! function_exists( 'sweem_block_sanitize_css_value' ) ) {
	function sweem_block_sanitize_css_value( $value ) {
		$value = trim( (string) $value );
		if ( '' === $value ) {
			return '';
		}
		if ( preg_match( '/^var\(--[a-zA-Z0-9_-]+\)$/', $value ) ) {
			return $value;
		}
		if ( preg_match( '/^#[0-9a-fA-F]{3,8}$/', $value ) ) {
			return $value;
		}
		if ( preg_match( '/^rgba?\([^)]+\)$/', $value ) || preg_match( '/^hsla?\([^)]+\)$/', $value ) ) {
			return $value;
		}
		if ( preg_match( '/^\d+(\.\d+)?(px|rem|em|%)$/', $value ) ) {
			return $value;
		}
		if ( in_array( strtolower( $value ), array( 'transparent', 'inherit', 'currentcolor' ), true ) ) {
			return $value;
		}
		return '';
	}
}

$social_items = array(
	array( 'url' => sweem_block_normalize_url( isset( $attributes['facebookUrl'] ) ? $attributes['facebookUrl'] : '' ), 'icon' => 'facebook' ),
	array( 'url' => sweem_block_normalize_url( isset( $attributes['twitterUrl'] ) ? $attributes['twitterUrl'] : '' ), 'icon' => 'twitter' ),
	array( 'url' => sweem_block_normalize_url( isset( $attributes['linkedinUrl'] ) ? $attributes['linkedinUrl'] : '' ), 'icon' => 'linkedin' ),
	array( 'url' => sweem_block_normalize_url( isset( $attributes['instagramUrl'] ) ? $attributes['instagramUrl'] : '' ), 'icon' => 'instagram' ),
);

$style_settings = isset( $attributes['styleSettings'] ) && is_array( $attributes['styleSettings'] ) ? $attributes['styleSettings'] : array();
$current_style_settings = isset( $style_settings[ $skin_style ] ) && is_array( $style_settings[ $skin_style ] ) ? $style_settings[ $skin_style ] : array();
$wrapper_style_items = array();
$style_map = array(
	'titleColor'      => '--sweem-title-color',
	'subtitleColor'   => '--sweem-subtitle-color',
	'cardBgColor'     => '--sweem-card-bg',
	'contentBgColor'  => '--sweem-content-bg',
	'socialBgColor'   => '--sweem-social-bg',
	'socialIconColor' => '--sweem-social-icon-color',
	'imageRadius'     => '--sweem-image-radius',
);

foreach ( $style_map as $field => $css_var ) {
	if ( empty( $current_style_settings[ $field ] ) ) {
		continue;
	}
	$sanitized_value = sweem_block_sanitize_css_value( $current_style_settings[ $field ] );
	if ( '' !== $sanitized_value ) {
		$wrapper_style_items[] = $css_var . ':' . $sanitized_value;
	}
}

$wrapper_style = implode( ';', $wrapper_style_items );
?>

<div <?php echo get_block_wrapper_attributes( array( 'class' => 'sweem-team-block ' . $theme_class . ' sweem-team-item', 'style' => $wrapper_style ) ); ?>>
	<?php if ( 'style1' === $skin_style ) : ?>
		<div class="sweem-inner-box">
			<?php if ( ! empty( $img_url ) ) : ?><div class="sweem-image"><img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>"></div><?php endif; ?>
			<div class="sweem-socials">
				<i class="fa fa-plus" aria-hidden="true"></i>
				<div class="sweem-social-links"><?php sweem_block_render_social_links( $social_items ); ?></div>
			</div>
			<div class="sweem-content-box">
				<?php if ( ! empty( $name ) ) : ?><h4 class="sweem-team-title"><?php echo esc_html( $name ); ?></h4><?php endif; ?>
				<?php if ( ! empty( $designation ) ) : ?><p class="sweem-team-subtitle"><?php echo esc_html( $designation ); ?></p><?php endif; ?>
			</div>
		</div>
	<?php elseif ( 'style2' === $skin_style ) : ?>
		<div class="sweem-inner-box">
			<div class="sweem-image-box">
				<?php if ( ! empty( $img_url ) ) : ?><div class="sweem-image"><img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>"></div><?php endif; ?>
				<div class="sweem-socials">
					<i class="fa fa-share" aria-hidden="true"></i>
					<div class="sweem-social-links"><?php sweem_block_render_social_links( $social_items ); ?></div>
				</div>
			</div>
			<div class="sweem-content-box">
				<?php if ( ! empty( $name ) ) : ?><h4 class="sweem-team-title"><?php echo esc_html( $name ); ?></h4><?php endif; ?>
				<?php if ( ! empty( $designation ) ) : ?><p class="sweem-team-subtitle"><?php echo esc_html( $designation ); ?></p><?php endif; ?>
			</div>
		</div>
	<?php elseif ( 'style3' === $skin_style ) : ?>
		<div class="sweem-inner-box">
			<div class="sweem-image-box">
				<?php if ( ! empty( $img_url ) ) : ?>
					<div class="sweem-image">
						<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
					</div>
				<?php endif; ?>
				<div class="sweem-social-links"><?php sweem_block_render_social_links( $social_items ); ?></div>
			</div>
			<div class="sweem-content-box">
				<?php if ( ! empty( $name ) ) : ?><h4 class="sweem-team-title"><?php echo esc_html( $name ); ?></h4><?php endif; ?>
				<?php if ( ! empty( $designation ) ) : ?><p class="sweem-team-subtitle"><?php echo esc_html( $designation ); ?></p><?php endif; ?>
			</div>
		</div>
	<?php elseif ( 'style4' === $skin_style ) : ?>
		<div class="sweem-inner-box">
			<div class="sweem-image-box">
				<?php if ( ! empty( $img_url ) ) : ?>
					<div class="sweem-image"><img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>"></div>
				<?php endif; ?>
				<div class="sweem-social-links"><?php sweem_block_render_social_links( $social_items ); ?></div>
			</div>
			<div class="sweem-info-box">
				<?php if ( ! empty( $designation ) ) : ?><p class="sweem-team-subtitle"><?php echo esc_html( $designation ); ?></p><?php endif; ?>
				<?php if ( ! empty( $name ) ) : ?><h4 class="sweem-team-title"><?php echo esc_html( $name ); ?></h4><?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>