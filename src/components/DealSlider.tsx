import React, { useCallback } from "react";
import "../index.css";
import useEmblaCarousel from "embla-carousel-react";
import { travelDeals } from "../constants/travelDeals";

export function EmblaCarousel() {
  const [emblaRef, emblaApi] = useEmblaCarousel();
  const scrollPrev = useCallback(() => {
    if (emblaApi) emblaApi.scrollPrev();
  }, [emblaApi]);

  const scrollNext = useCallback(() => {
    if (emblaApi) emblaApi.scrollNext();
  }, [emblaApi]);

  return (
    <div className=" overflow-hidden" ref={emblaRef}>
      <div className="flex">
        {travelDeals.map((deal) => (
          <div className="flex-[0_0_50%] min-w-0" key={deal.id}>
            <div>
              <img
                src={deal.imageUrl}
                alt={deal.title}
                className="w-full h-auto"
              />
              <h2 className="text-lg font-bold">{deal.title}</h2>
              <p>{deal.description}</p>
              <p className="text-green-500">Price: ${deal.price}</p>
              <p className="text-red-500">Discount: {deal.discount}%</p>
              <p>Rating: {deal.rating} stars</p>
            </div>
          </div>
        ))}
        <button className="embla__prev" onClick={scrollPrev}>
          Prev
        </button>
        <button className="embla__next" onClick={scrollNext}>
          Next
        </button>
      </div>
    </div>
  );
}
