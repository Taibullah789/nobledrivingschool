import Hero from '../components/Hero'
import About from '../components/About'
import Pricing from '../components/Pricing'
import Services from '../components/Services'
import Blogs from '../components/Blogs'
import Testimonials from '../components/Testimonials'
import FAQ from '../components/FAQ'
import v1 from '../assets/v1.mp4'

const HomePage = () => {
  return (
    <div>
      <Hero />
      <About />
      <Pricing />
      <Services />
      <Blogs />
      
      {/* Video Section */}
      <section className="py-20 bg-gray-200">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12">
            <h2 className="text-4xl font-bold text-gray-800 mb-4">Watch Our Training</h2>
            <div className="w-16 h-1 bg-green-500 mx-auto"></div>
          </div>
          <div className="max-w-4xl mx-auto">
            <video
              className="w-full h-auto rounded-lg shadow-lg"
              controls
              poster=""
            >
              <source src={v1} type="video/mp4" />
              Your browser does not support the video tag.
            </video>
          </div>
        </div>
      </section>

      <Testimonials />
      <FAQ />
    </div>
  )
}

export default HomePage
