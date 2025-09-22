import { useState } from 'react'

const Testimonials = () => {
  const testimonials = [
    "Best Price in town! After calling another schools, I was convinced that only noble driving Academy Could provide a great services at low cost",
    "Noble Driving Academy has taught my son to be very safe",
    "I am very impressed with the care I received from the staff who took their time to address my needs. Noble Driving Academy tailored a program that met my needs and fit my busy schedule. As a result, I am now a licensed driver",
    "Great Followup and amazing Communication Skills",
    "I received an email after each lesson regarding my child's Progress"
  ]

  const [currentSlide, setCurrentSlide] = useState(0)

  const handleDotClick = (index) => {
    setCurrentSlide(index)
  }

  // We have 5 testimonials, so 5 dots (one for each testimonial)
  const totalSlides = testimonials.length

  return (
    <section id="testimonials" className="py-16 sm:py-20 bg-white">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12 sm:mb-16">
          <h2 className="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">Testimonials</h2>
          <div className="w-16 h-1 bg-green-500 mx-auto"></div>
        </div>

        {/* Sliding Container */}
        <div className="relative overflow-hidden">
          <div 
            className="flex transition-transform duration-700 ease-in-out"
            style={{ transform: `translateX(-${currentSlide * (100 / 3)}%)` }}
          >
            {testimonials.map((testimonial, index) => (
              <div key={index} className="w-1/3 flex-shrink-0 px-2 sm:px-4">
                <div className="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-lg text-center h-full">
                  <div className="text-4xl sm:text-6xl text-green-500 mb-2 sm:mb-4">"</div>
                  <p className="text-gray-600 text-sm sm:text-base lg:text-lg italic">{testimonial}</p>
                </div>
              </div>
            ))}
            {/* Add duplicate testimonials to ensure we can show the last 3 properly */}
            {testimonials.slice(0, 2).map((testimonial, index) => (
              <div key={`duplicate-${index}`} className="w-1/3 flex-shrink-0 px-2 sm:px-4">
                <div className="bg-white p-4 sm:p-6 lg:p-8 rounded-lg shadow-lg text-center h-full">
                  <div className="text-4xl sm:text-6xl text-green-500 mb-2 sm:mb-4">"</div>
                  <p className="text-gray-600 text-sm sm:text-base lg:text-lg italic">{testimonial}</p>
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Pagination Dots */}
        <div className="flex justify-center mt-12 space-x-2">
          {Array.from({ length: totalSlides }, (_, index) => (
            <button
              key={index}
              onClick={() => handleDotClick(index)}
              className={`w-3 h-3 rounded-full transition-colors duration-300 ${
                index === currentSlide ? 'bg-gray-800' : 'bg-green-500'
              }`}
            />
          ))}
        </div>
      </div>
    </section>
  )
}

export default Testimonials
