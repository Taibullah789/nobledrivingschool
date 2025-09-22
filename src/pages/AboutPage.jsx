import { Link } from 'react-router-dom'
import AboutHero from '../components/AboutHero'
import Testimonials from '../components/Testimonials'
import ab1 from '../assets/ab1.png'
import ab2 from '../assets/ab2.jpg'
import ab3 from '../assets/ab3.jpg'
import v1 from '../assets/v1.mp4'

const AboutPage = () => {

  return (
    <div className="min-h-screen bg-white">
      <AboutHero />

      {/* Feature Bar */}
      <section className="bg-gray-800 py-4">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 md:grid-cols-5 gap-4 text-center">
            <div className="text-white font-medium">Insured & Bonded</div>
            <div className="text-white font-medium">Brand New Vehicle</div>
            <div className="text-white font-medium">Bi-Lingual & Friendly Instructor</div>
            <div className="text-white font-medium">Serving all Northern</div>
            <div className="text-white font-medium">24 Years of Experience</div>
          </div>
          </div>
      </section>

      {/* Welcome Section */}
      <section className="py-16 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
              <h2 className="text-2xl font-bold text-green-600 mb-6">WELCOME TO</h2>
              <h3 className="text-3xl font-bold text-gray-800 mb-6">Noble Driving Academy</h3>
              <p className="text-lg text-gray-600 leading-relaxed">
                Our "Driving in the Real World (DITW)" program is a thought-altering programme that encourages new perspectives on real-world street driving and transportation safety. The American driver education system has failed to keep pace with the growing complexity of our transportation system. The U.S. ranks 29th out of 30 developed countries in transportation fatalities. It's time for a change. We approach traffic safety as an entire ecosystem.
              </p>
            </div>
            <div className="order-first lg:order-last">
              <img 
                src={ab1} 
                alt="Driving on scenic road" 
                className="w-full h-96 object-cover rounded-lg shadow-lg"
              />
            </div>
          </div>
        </div>
      </section>

      {/* Our Vision Section */}
      <section className="py-16 bg-gray-50">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
              <img 
                src={ab2} 
                alt="Hands on steering wheel" 
                className="w-full h-96 object-cover rounded-lg shadow-lg"
              />
                </div>
            <div>
              <h2 className="text-4xl font-bold text-gray-800 mb-6">
                <span className="border-b-4 border-green-500 pb-2 inline-block">Our</span> Vision
              </h2>
              <p className="text-lg text-gray-600 leading-relaxed">
                Parallel Parking is one of the most challenging and feared tests. At Noble Driving Academy, we train learners to overcome difficult driving skills. We believe in imparting the right driving tips for safety. Our behind-the-wheel lessons prioritize basic safety lessons and making learners aware of the rules.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* Our Mission Section */}
      <section className="py-16 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
              <h2 className="text-4xl font-bold text-gray-800 mb-6">
                <span className="border-b-4 border-green-500 pb-2 inline-block">Our</span> Mission
              </h2>
              <p className="text-lg text-gray-600 leading-relaxed">
                Our mission is to familiarize learners with street traffic guidelines and make new drivers responsible for their driving habits. We ensure all objectives are met with patience in our approach and special attention to learners. NDA's professional driving lessons are tailored to suit individual needs, and our instructors will devote extra time to ensure learners excel in specific driving forms with full finesse.
              </p>
            </div>
            <div>
              <img 
                src={ab3} 
                alt="Driver with lighthouse view" 
                className="w-full h-96 object-cover rounded-lg shadow-lg"
              />
            </div>
          </div>
        </div>
      </section>

      {/* Request An Appointments Section */}
      <section className="relative py-20 bg-gray-900">
        <div className="absolute inset-0">
          <video
            className="w-full h-full object-cover opacity-30"
            autoPlay
            muted
            loop
          >
            <source src={v1} type="video/mp4" />
          </video>
        </div>
        <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h2 className="text-4xl font-bold text-white mb-4">Request An Appointments</h2>
          <div className="w-16 h-1 bg-green-500 mx-auto mb-6"></div>
          <p className="text-white text-lg mb-8">
            Send us a message directly or registered by clicking mentioned buttons:
          </p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Link 
              to="/contact" 
              className="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors text-center"
            >
              Contact
            </Link>
            <Link 
              to="/registration-form" 
              className="bg-black text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition-colors text-center"
            >
              Register Now
            </Link>
          </div>
        </div>
      </section>

      {/* Testimonials Section */}
      <Testimonials />
    </div>
  )
}

export default AboutPage
