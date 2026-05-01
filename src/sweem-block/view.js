const teamBlocks = document.querySelectorAll('.wp-block-create-block-sweem-block.sweem-team-block');

if (teamBlocks.length) {
	const closeAllSocialMenus = () => {
		document
			.querySelectorAll('.wp-block-create-block-sweem-block.sweem-team-block .sweem-socials-icon-box.is-open, .wp-block-create-block-sweem-block.sweem-team-block .sweem-social-wrap.is-open, .wp-block-create-block-sweem-block.sweem-team-block .sweem-socials.is-open, .wp-block-create-block-sweem-block.sweem-team-block .sweem-team-content.is-open, .wp-block-create-block-sweem-block.sweem-team-block .sweem-image.is-open')
			.forEach((el) => el.classList.remove('is-open'));
	};

	teamBlocks.forEach((block) => {
		const shareButton = block.querySelector('.sweem-share-icon, .sweem-socials i');
		const socialBox = block.querySelector('.sweem-socials-icon-box');
		const socialWrap = block.querySelector('.sweem-social-wrap');
		const socialsBox = block.querySelector('.sweem-socials');
		const teamContent = block.querySelector('.sweem-team-content');
		const imageBox = block.querySelector('.sweem-team-content .sweem-image');

		if (!shareButton) {
			return;
		}

		shareButton.addEventListener('click', (event) => {
			event.preventDefault();
			event.stopPropagation();

			const container =
				shareButton.closest('.sweem-socials-icon-box') ||
				shareButton.closest('.sweem-social-wrap') ||
				shareButton.closest('.sweem-socials') ||
				shareButton.closest('.sweem-team-content') ||
				socialWrap ||
				socialsBox ||
				teamContent ||
				socialBox ||
				imageBox;
			if (!container) {
				return;
			}

			const shouldOpen = !container.classList.contains('is-open');
			closeAllSocialMenus();

			if (shouldOpen) {
				container.classList.add('is-open');
			}
		});
	});

	document.addEventListener('click', closeAllSocialMenus);
}
