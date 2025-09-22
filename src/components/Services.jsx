import nobleLogo from '../assets/noblelogo.jpg'

const Services = () => {
  const services = [
    "Teenage Behind the Wheel Training",
    "Teenage Classroom Instruction", 
    "5 Point Driving Improvement Class",
    "Adult Behind the Training Wheel",
    "Pickup And Drop Services"
  ]

  return (
    <section id="services" className="py-16 sm:py-20 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12 sm:mb-16">
          <h2 className="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">What We Do</h2>
          <div className="w-16 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
          {services.map((service, index) => (
            <div key={index} className="bg-gray-100 p-6 sm:p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
              <h3 className="text-lg sm:text-xl font-semibold text-gray-800 mb-4">{service}</h3>
              <div className="w-12 h-1 bg-green-500"></div>
            </div>
          ))}
          
          {/* Logo in second row */}
          <div className="bg-gray-100 p-6 sm:p-8 rounded-lg shadow-md flex items-center justify-center">
            <img
              src={nobleLogo}
              alt="Noble Driving Academy"
              className="h-12 sm:h-16 w-auto"
            />
          </div>
        </div>
      </div>
    </section>
  )
}

export default Services
