import bowser from 'bowser'

const browser = bowser.getParser(window.navigator.userAgent)
const platformIsMobile = browser.getPlatformType(true) === 'mobile'

export default (breakpoint = 768) => platformIsMobile || window.innerWidth < breakpoint
