import bl from '../assets/bl.jpg'

const ServicesHero = () => {
  return (
    <section className="relative h-[60vh] flex items-center justify-center">
      {/* Background Image - bl */}
      <div className="absolute inset-0 bg-cover bg-center bg-no-repeat" 
           style={{backgroundImage: `url(${bl})`}}>
        <div className="absolute inset-0 bg-black bg-opacity-40"></div>
      </div>

      {/* Content - Centered "What We Do" */}
      <div className="relative z-10 text-center">
        <h1 className="text-4xl md:text-5xl font-bold text-white">
          What We Do
        </h1>
        <div className="w-24 h-1 bg-green-500 mx-auto mt-4"></div>
      </div>
    </section>
  )
}

export default ServicesHero
