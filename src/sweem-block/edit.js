import {
	useBlockProps,
	RichText,
	MediaPlaceholder,
	InspectorControls,
	BlockControls,
	MediaReplaceFlow,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import './editor.scss';

const SocialIcon = ({ network }) => <i className={ `fa fa-${ network }` } aria-hidden="true" />;

const socialNetworks = [
	{ key: 'facebookUrl', network: 'facebook' },
	{ key: 'twitterUrl', network: 'twitter' },
	{ key: 'linkedinUrl', network: 'linkedin' },
	{ key: 'instagramUrl', network: 'instagram' },
];

export default function Edit({ attributes, setAttributes }) {
	const {
		name,
		designation,
		imgUrl,
		imgAlt,
		facebookUrl,
		twitterUrl,
		linkedinUrl,
		instagramUrl,
		skinStyle,
	} = attributes;

	const socialItems = socialNetworks
		.map((item) => ({
			...item,
			value: attributes[item.key],
		}))
		.filter((item) => item.value);

	const skinClass = `sweem-team-block sweem-current-theme${ skinStyle.replace('style', '') } sweem-team-item`;
	const onSelectImage = (media) =>
		setAttributes({
			imgUrl: media?.url || '',
			imgId: media?.id || 0,
			imgAlt: media?.alt || '',
		});
	const onRemoveImage = () =>
		setAttributes({
			imgUrl: '',
			imgId: 0,
			imgAlt: '',
		});
	const renderSocialLinks = () => {
		if (!socialItems.length) {
			return (
				<span className="social-placeholder">
					{ __('Add social links from block settings', 'sweem-block') }
				</span>
			);
		}

		return socialItems.map((item) => (
			<a className="sweem-social-link" key={ item.key } href={ item.value } target="_blank" rel="noreferrer">
				<SocialIcon network={ item.network } />
			</a>
		));
	};

	const renderImage = () =>
		imgUrl ? (
			<img src={ imgUrl } alt={ imgAlt || name || __('Team member', 'sweem-block') } />
		) : (
			<MediaPlaceholder
				onSelect={ onSelectImage }
				allowedTypes={ [ 'image' ] }
				labels={{ title: __('Select Member Photo', 'sweem-block') }}
			/>
		);

	const renderInfo = () => (
	<div className="sweem-info">
			<RichText
				tagName="h4"
				className="sweem-team-title"
				value={ name }
				onChange={ (value) => setAttributes({ name: value }) }
				placeholder={ __('Enter Name...', 'sweem-block') }
			/>
			<RichText
				tagName="p"
				className="sweem-team-subtitle"
				value={ designation }
				onChange={ (value) => setAttributes({ designation: value }) }
				placeholder={ __('Enter Designation...', 'sweem-block') }
			/>
		</div>
	);

	const renderSkinLayout = () => {
		switch (skinStyle) {
			case 'style3':
				return (
					<div className="sweem-inner-box">
						<div className="sweem-image-box">
							<div className="sweem-image">{ renderImage() }</div>
							<div className="sweem-social-links">{ renderSocialLinks() }</div>
						</div>
						<div className="sweem-content-box">{ renderInfo() }</div>
					</div>
				);
			case 'style4':
				return (
					<div className="sweem-inner-box">
						<div className="sweem-image-box">
							<div className="sweem-image">{ renderImage() }</div>
							<div className="sweem-social-links">{ renderSocialLinks() }</div>
						</div>
						<div className="sweem-info-box">
							<RichText
								tagName="p"
								className="sweem-team-subtitle"
								value={ designation }
								onChange={ (value) => setAttributes({ designation: value }) }
								placeholder={ __('Enter Designation...', 'sweem-block') }
							/>
							<RichText
								tagName="h4"
								className="sweem-team-title"
								value={ name }
								onChange={ (value) => setAttributes({ name: value }) }
								placeholder={ __('Enter Name...', 'sweem-block') }
							/>
						</div>
					</div>
				);
			case 'style1':
				return (
					<div className="sweem-inner-box">
						<div className="sweem-image">{ renderImage() }</div>
						<div className="sweem-socials">
							<i className="fa fa-plus" aria-hidden="true"></i>
							<div className="sweem-social-links">{ renderSocialLinks() }</div>
						</div>
						<div className="sweem-content-box">{ renderInfo() }</div>
					</div>
				);
			case 'style2':
			default:
				return (
					<div className="sweem-inner-box">
						<div className="sweem-image-box">
							<div className="sweem-image">{ renderImage() }</div>
							<div className="sweem-socials">
								<i className="fa fa-share" aria-hidden="true"></i>
								<div className="sweem-social-links">{ renderSocialLinks() }</div>
							</div>
						</div>
						<div className="sweem-content-box">{ renderInfo() }</div>
					</div>
				);
		}
	};

	return (
		<>
			<BlockControls>
				<MediaReplaceFlow
					mediaId={ attributes.imgId }
					mediaURL={ imgUrl }
					allowedTypes={ [ 'image' ] }
					accept="image/*"
					onSelect={ onSelectImage }
					onReset={ onRemoveImage }
				/>
			</BlockControls>
			<InspectorControls>
				<PanelBody title={ __('Skin Settings', 'sweem-block') } initialOpen={ true }>
					<SelectControl
						label={ __('Select Skin Style', 'sweem-block') }
						value={ skinStyle }
						options={ [
							{ label: __('Style 1', 'sweem-block'), value: 'style1' },
							{ label: __('Style 2', 'sweem-block'), value: 'style2' },
							{ label: __('Style 3', 'sweem-block'), value: 'style3' },
							{ label: __('Style 4', 'sweem-block'), value: 'style4' },
						] }
						onChange={ (value) => setAttributes({ skinStyle: value }) }
					/>
				</PanelBody>
				<PanelBody title={ __('Image Settings', 'sweem-block') } initialOpen={ true }>
					<MediaUploadCheck>
						<MediaUpload
							onSelect={ onSelectImage }
							allowedTypes={ [ 'image' ] }
							value={ attributes.imgId }
							render={ ({ open }) => (
								<Button variant="secondary" onClick={ open }>
									{ imgUrl ? __('Replace Image', 'sweem-block') : __('Select Image', 'sweem-block') }
								</Button>
							) }
						/>
					</MediaUploadCheck>
					{ imgUrl ? (
						<Button
							variant="link"
							isDestructive
							onClick={ onRemoveImage }
							style={{ display: 'block', marginTop: '8px' }}
						>
							{ __('Remove Image', 'sweem-block') }
						</Button>
					) : null }
				</PanelBody>
				<PanelBody title={ __('Social Links', 'sweem-block') } initialOpen={ true }>
					<TextControl
						label={ __('Facebook URL', 'sweem-block') }
						value={ facebookUrl }
						onChange={ (value) => setAttributes({ facebookUrl: value }) }
					/>
					<TextControl
						label={ __('X (Twitter) URL', 'sweem-block') }
						value={ twitterUrl }
						onChange={ (value) => setAttributes({ twitterUrl: value }) }
					/>
					<TextControl
						label={ __('LinkedIn URL', 'sweem-block') }
						value={ linkedinUrl }
						onChange={ (value) => setAttributes({ linkedinUrl: value }) }
					/>
					<TextControl
						label={ __('Instagram URL', 'sweem-block') }
						value={ instagramUrl }
						onChange={ (value) => setAttributes({ instagramUrl: value }) }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...useBlockProps({ className: skinClass }) }>
				{ renderSkinLayout() }
			</div>
		</>
	);
}