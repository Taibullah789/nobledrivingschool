import { Link, useLocation } from 'react-router-dom'
import { useState } from 'react'
import nobleLogo from '../assets/noblelogo.jpg'

const Header = () => {
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false)
  const location = useLocation()

  const isActive = (path) => {
    if (path === '/' && location.pathname === '/') return true
    if (path !== '/' && location.pathname.startsWith(path)) return true
    return false
  }

  const navigation = [
    { name: 'Home', path: '/' },
    { name: 'Services', path: '/services' },
    { name: 'Blogs', path: '/blogs' },
    { name: 'About', path: '/about' },
    { name: 'Contact', path: '/contact' }
  ]

  return (
    <header className="bg-white fixed top-0 w-full z-50">
      {/* Top Contact Bar */}
      <div className="bg-white py-3">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center">
            {/* Left Side - Contact Info */}
            <div className="flex items-center space-x-8">
              <div className="flex items-center space-x-2">
                <svg className="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                </svg>
                <div>
                  <div className="text-gray-600 text-sm">Call Us</div>
                  <div className="text-gray-800 font-medium">+1-703-789-3404</div>
                </div>
              </div>
              <div className="flex items-center space-x-2">
                <svg className="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <div>
                  <div className="text-gray-600 text-sm">Email us</div>
                  <div className="text-gray-800 font-medium">info@dev.nobledrivingacademy.com</div>
                </div>
              </div>
            </div>

            {/* Center - Logo */}
            <div className="flex-1 flex justify-center">
              <Link to="/" className="flex items-center">
                <img 
                  src={nobleLogo} 
                  alt="Noble Driving Academy" 
                  className="h-20 w-auto"
                />
              </Link>
            </div>

            {/* Right Side - Register Button */}
            <div>
              <Link 
                to="/registration-form" 
                className="bg-green-600 text-white px-6 py-3 rounded-md text-sm font-semibold hover:bg-green-700 transition-colors inline-block"
              >
                Register Now
              </Link>
            </div>
          </div>
        </div>
      </div>

      {/* Navigation Bar */}
      <div className="bg-white border-t border-gray-200">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-center py-4">
            {/* Desktop Navigation */}
            <nav className="hidden md:flex space-x-8">
              {navigation.map((item) => (
                <Link
                  key={item.name}
                  to={item.path}
                  className={`text-lg font-medium transition-colors ${
                    isActive(item.path)
                      ? 'text-green-600'
                      : 'text-gray-700 hover:text-green-600'
                  }`}
                >
                  {item.name}
                </Link>
              ))}
            </nav>

            {/* Mobile Menu Button */}
            <button 
              className="md:hidden text-gray-700 p-2"
              onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
            >
              <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
          </div>

          {/* Mobile Navigation */}
          {isMobileMenuOpen && (
            <div className="md:hidden border-t border-gray-200 py-4">
              <nav className="flex flex-col space-y-4">
                {navigation.map((item) => (
                  <Link
                    key={item.name}
                    to={item.path}
                    className={`text-lg font-medium transition-colors ${
                      isActive(item.path)
                        ? 'text-green-600'
                        : 'text-gray-700 hover:text-green-600'
                    }`}
                    onClick={() => setIsMobileMenuOpen(false)}
                  >
                    {item.name}
                  </Link>
                ))}
                <div className="pt-4 border-t border-gray-200">
                  <Link 
                    to="/registration-form" 
                    className="bg-green-600 text-white px-6 py-3 rounded-md text-sm font-semibold hover:bg-green-700 transition-colors inline-block"
                    onClick={() => setIsMobileMenuOpen(false)}
                  >
                    Register Now
                  </Link>
                </div>
              </nav>
            </div>
          )}
        </div>
      </div>

    </header>
  )
}

export default Header
