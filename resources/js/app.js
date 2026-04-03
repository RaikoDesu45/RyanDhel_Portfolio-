import './bootstrap';
import mountHeroRoleAnimator from './components/HeroRoleAnimator';
import mountSkillTapeAnimator from './components/SkillTapeAnimator';
import mountScrollRevealAnimator from './components/ScrollRevealAnimator';

const mountPortfolioAnimations = () => {
	mountHeroRoleAnimator();
	mountSkillTapeAnimator();
	mountScrollRevealAnimator();
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', mountPortfolioAnimations, { once: true });
} else {
	mountPortfolioAnimations();
}
