import { Link } from 'react-router-dom'
import whoImage from '../assets/who.jpg'

const About = () => {
  return (
    <section id="about" className="py-16 sm:py-20 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
          {/* Text Content */}
          <div className="order-2 lg:order-1">
            <div className="w-16 h-1 bg-green-500 mb-4 sm:mb-6"></div>
            <h2 className="text-3xl sm:text-4xl font-bold text-gray-800 mb-4 sm:mb-6">Who We Are</h2>
            <h3 className="text-2xl sm:text-3xl font-bold text-gray-800 mb-4 sm:mb-6">Noble Driving Academy</h3>
            
            <div className="space-y-3 sm:space-y-4 text-gray-600 text-sm sm:text-base">
              <p>
                We provide exceptional while saving cost for students. We are a one stop shop for all your driving needs. 
                We provide the best care and training in our 2022 fleet of vehicle. Our Student is our priority.
              </p>
              <p>
                We believe that driver education is one of the most important classes in personal life. Defensive driving 
                techniques and being a patient and courteous driver can make the difference between life and death.
              </p>
            </div>
            
            <Link 
              to="/about" 
              className="mt-6 sm:mt-8 bg-green-600 text-white px-6 sm:px-8 py-2 sm:py-3 rounded-md font-medium hover:bg-green-700 transition-colors inline-block text-sm sm:text-base"
            >
              Read More
            </Link>
          </div>

          {/* Image */}
          <div className="relative order-1 lg:order-2">
            <img 
              src={whoImage} 
              alt="Who We Are - Noble Driving Academy" 
              className="w-full h-64 sm:h-80 lg:h-96 object-cover rounded-lg shadow-lg"
            />
          </div>
        </div>
      </div>
    </section>
  )
}

export default About
