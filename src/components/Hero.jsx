import { Link } from 'react-router-dom'

const Hero = () => {
  return (
    <section id="home" className="relative min-h-screen flex items-center">
      {/* Background Image - Car Interior View */}
      <div className="absolute inset-0 bg-cover bg-center bg-no-repeat" 
           style={{backgroundImage: "url('https://images.unsplash.com/photo-1449824913935-59a10b8d2000?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')"}}>
        <div className="absolute inset-0 bg-black bg-opacity-60"></div>
      </div>

      {/* Content - Responsive Layout */}
      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 sm:pt-24">
        <div className="max-w-2xl mx-auto text-center sm:text-left">
          <div className="mb-4">
            <span className="text-green-400 text-lg font-medium">WE TEACH</span>
          </div>
          <h1 className="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 sm:mb-8 leading-tight">
            Driver<br />Intelligence
          </h1>
          <div className="flex items-center justify-center sm:justify-start space-x-4 mb-12 sm:mb-16">
            <Link 
              to="/about" 
              className="text-white text-lg font-medium hover:text-green-400 transition-colors"
            >
              Read Now
            </Link>
            <div className="w-8 h-8 border-2 border-white rounded-full flex items-center justify-center hover:translate-x-2 transition-transform duration-300 cursor-pointer group">
              <span className="text-green-400 text-sm group-hover:translate-x-1 transition-transform duration-300">→</span>
            </div>
          </div>
        </div>

        {/* Social Media Links - Responsive Positioning */}
        <div className="absolute bottom-4 sm:bottom-8 left-4 sm:left-8 text-white">
          <div className="flex space-x-4 sm:space-x-6 text-xs sm:text-sm">
            <a href="https://www.facebook.com/nobledrivingacademy/" target="_blank" rel="noopener noreferrer" className="hover:text-green-400 transition-colors">FACEBOOK</a>
            <a href="https://www.instagram.com/nobledrivingacademy/" target="_blank" rel="noopener noreferrer" className="hover:text-green-400 transition-colors">INSTAGRAM</a>
          </div>
        </div>
      </div>

      {/* Feature Bar - Responsive */}
      <div className="absolute bottom-0 left-0 right-0 bg-gray-800 text-white py-3 sm:py-4">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-2 sm:gap-4 text-center text-xs sm:text-sm">
            <div className="flex items-center justify-center space-x-1 sm:space-x-2">
              <span className="text-green-400">✓</span>
              <span className="truncate">Insured & Bonded</span>
            </div>
            <div className="flex items-center justify-center space-x-1 sm:space-x-2">
              <span className="text-green-400">✓</span>
              <span className="truncate">Brand New Vehicle</span>
            </div>
            <div className="flex items-center justify-center space-x-1 sm:space-x-2">
              <span className="text-green-400">✓</span>
              <span className="truncate">Bi-Lingual & Friendly Instructor</span>
            </div>
            <div className="flex items-center justify-center space-x-1 sm:space-x-2">
              <span className="text-green-400">✓</span>
              <span className="truncate">Serving all Northern</span>
            </div>
            <div className="flex items-center justify-center space-x-1 sm:space-x-2">
              <span className="text-green-400">✓</span>
              <span className="truncate">24 Years of Experience</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}

export default Hero
