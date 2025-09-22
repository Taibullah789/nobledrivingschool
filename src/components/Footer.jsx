import { Link } from 'react-router-dom'
import { FaMapMarkerAlt, FaFacebookF, FaInstagram } from 'react-icons/fa'
import nobleLogo from '../assets/noblelogo.jpg'

const Footer = () => {
  return (
    <footer className="bg-white text-gray-700">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
          {/* Company Info */}
          <div className="sm:col-span-2 lg:col-span-1">
            <div className="flex items-center space-x-3 mb-4 sm:mb-6">
              <img
                src={nobleLogo}
                alt="Noble Driving Academy"
                className="h-12 sm:h-16 w-auto"
              />
            </div>
            <p className="text-gray-600 leading-relaxed text-sm sm:text-base">
              We believe that driver education is one of the most important classes in personal life.
              Noble Driving Academy takes our role as educators very seriously. The safety of student is primary goal.
            </p>
          </div>

          {/* Quick Links */}
          <div>
            <h3 className="text-base sm:text-lg font-semibold text-gray-800 mb-3 sm:mb-4">
              <span className="border-b-2 border-green-500 pb-1">Quick Links</span>
            </h3>
            <ul className="space-y-2 sm:space-y-3">
              <li>
                <Link to="/about" className="flex items-center text-gray-600 hover:text-green-600 transition-colors text-sm sm:text-base">
                  <span className="text-green-500 mr-2">✓</span>
                  About
                </Link>
              </li>
              <li>
                <Link to="/testimonials" className="flex items-center text-gray-600 hover:text-green-600 transition-colors text-sm sm:text-base">
                  <span className="text-green-500 mr-2">✓</span>
                  Testimonials
                </Link>
              </li>
              <li>
                <Link to="/services" className="flex items-center text-gray-600 hover:text-green-600 transition-colors text-sm sm:text-base">
                  <span className="text-green-500 mr-2">✓</span>
                  Services
                </Link>
              </li>
              <li>
                <Link to="/contact" className="flex items-center text-gray-600 hover:text-green-600 transition-colors text-sm sm:text-base">
                  <span className="text-green-500 mr-2">✓</span>
                  Contact
                </Link>
              </li>
            </ul>
          </div>

          {/* What We Do */}
          <div>
            <h3 className="text-base sm:text-lg font-semibold text-gray-800 mb-3 sm:mb-4">
              <span className="border-b-2 border-green-500 pb-1">What We Do</span>
            </h3>
            <ul className="space-y-2 sm:space-y-3">
              {[
                'Teenage Behind the wheel',
                'Driver Education Class',
                'Re-Examination',
                'Private Driving Lesson',
                'Adult Behind the wheel',
                '5 Point Driving Improvement Class'
              ].map((service, index) => (
                <li key={index}>
                  <Link to="/services" className="flex items-center text-gray-600 hover:text-green-600 transition-colors text-sm sm:text-base">
                    <span className="text-green-500 mr-2">→</span>
                    {service}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Contact Info */}
          <div>
            <h3 className="text-base sm:text-lg font-semibold text-gray-800 mb-3 sm:mb-4">
              <span className="border-b-2 border-green-500 pb-1">Contact Information</span>
            </h3>
            <div className="space-y-2 sm:space-y-3">
              <p className="text-gray-600 text-sm sm:text-base">Phone: +1-703-789-3404</p>
              <p className="text-gray-600 text-sm sm:text-base">Email: info@dev.nobledrivingacademy.com</p>
              <div className="flex items-start space-x-2">
                <FaMapMarkerAlt className="w-4 h-4 text-green-500 mt-1 flex-shrink-0" />
                <a 
                  href="https://goo.gl/maps/mbn7T9oP4YRVmJhU7" 
                  target="_blank" 
                  rel="noopener noreferrer"
                  className="text-gray-600 hover:text-green-600 transition-colors text-sm sm:text-base"
                >
                  5501 Cherokee Avenue Suite 200 Alexandria VA 22312
                </a>
              </div>
              <div className="flex space-x-4 mt-3 sm:mt-4">
                <a 
                  href="https://www.facebook.com/nobledrivingacademy/" 
                  target="_blank" 
                  rel="noopener noreferrer"
                  className="text-gray-600 hover:text-green-600 transition-colors"
                >
                  <FaFacebookF className="w-5 h-5 sm:w-6 sm:h-6" />
                </a>
                <a 
                  href="https://www.instagram.com/nobledrivingacademy/" 
                  target="_blank" 
                  rel="noopener noreferrer"
                  className="text-gray-600 hover:text-green-600 transition-colors"
                >
                  <FaInstagram className="w-5 h-5 sm:w-6 sm:h-6" />
                </a>
              </div>
            </div>
          </div>
        </div>

        {/* Bottom Bar */}
        <div className="border-t border-gray-200 mt-8 sm:mt-12 pt-6 sm:pt-8">
          <div className="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
            <div className="flex space-x-4 sm:space-x-6">
              <a href="#" className="text-gray-500 hover:text-gray-700 transition-colors text-sm">Term of use</a>
              <a href="#" className="text-gray-500 hover:text-gray-700 transition-colors text-sm">Privacy Policy</a>
            </div>
            <p className="text-gray-500 text-xs sm:text-sm text-center sm:text-right">
              Copyright ©2011. Noble Driving Academy. All Rights Reserved.
            </p>
          </div>
        </div>
      </div>
    </footer>
  )
}

export default Footer
